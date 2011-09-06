<?php

namespace Admin\Form\Section;

use \Litus\Form\Decorator\ButtonDecorator;
use \Litus\Form\Decorator\FieldDecorator;
use \Litus\Application\Resource\Doctrine as DoctrineResource;
use \Litus\Entity\Br\Contracts\Section;

use \Zend\Form\Form;
use \Zend\Form\Element\Select;
use \Zend\Form\Element\Submit;
use \Zend\Form\Element\Text;
use \Zend\Form\Element\Textarea;
use \Zend\Registry;
use \Zend\Validator\Float as FloatValidator;
use \Zend\Validator\Int as IntValidator;

class Add extends \Litus\Form\Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);

        $locale = Registry::get('litus.shortLocale');

        $this->setAction('/admin/section/add');
        $this->setMethod('post');

        $field = new Text('name');
        $field->setLabel('Name')
                ->setRequired()
                ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

		$field = new Text('price');
        $field->setLabel('Price')
                ->setRequired()
                ->setValue('0')
                ->setDecorators(array(new FieldDecorator()));
//				->addValidator(new FloatValidator(
//                       array('locale' => $locale)
//					));
        $this->addElement($field);

		$field = new Select('vat_type');
		$field->setLabel('VAT Type')
				->setRequired()
				->setMultiOptions($this->_getVatTypes())
				->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Textarea('content');
        $field->setLabel('Content')
                ->setRequired()
                ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Submit('submit');
        $field->setLabel('Add')
                ->setAttrib('class', 'sections_add')
                ->setDecorators(array(new ButtonDecorator()));
        $this->addElement($field);
    }

	private function _getVatTypes()
	{
        $return =  Registry::get(DoctrineResource::REGISTRY_KEY)
                ->getRepository('Litus\Entity\Config\Config')
                ->getAllByPrefix(Section::VAT_CONFIG_PREFIX);

        foreach ($return as $key => $value)
            $return[$key] .= '%';

        return $return;
	}
}