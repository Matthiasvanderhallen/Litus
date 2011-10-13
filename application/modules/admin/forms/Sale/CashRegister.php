<?php

namespace Admin\Form\Sale;

use \Litus\Form\Admin\Decorator\ButtonDecorator;
use \Litus\Form\Admin\Decorator\FieldDecorator;
use \Litus\Application\Resource\Doctrine as DoctrineResource;

use \Zend\Form\Form;
use \Zend\Form\Element\Hidden;
use \Zend\Form\Element\Submit;
use \Zend\Form\Element\Text;
use \Zend\Form\Element\Textarea;
use \Zend\Validator;
use \Zend\Registry;

class CashRegister extends \Litus\Form\Admin\Form
{
    public function __construct( $initialValues, $options = null )
    {
        parent::__construct($options);

        $field = new Hidden('name');
        $field->setValue('changeme456789352');
        $this->addElement($field);

        $field = new Text('500');
        $field->setLabel('500')
            ->setRequired()
            ->setValue($initialValues['500'])
       //     ->addValidator('regex', false, array('/^[0-9]+$/'))
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('200');
        $field->setLabel('200')
            ->setRequired()
            ->setValue($initialValues['200'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('100');
        $field->setLabel('100')
            ->setRequired()
            ->setValue($initialValues['100'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('50');
        $field->setLabel('50')
            ->setRequired()
            ->setValue($initialValues['50'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('20');
        $field->setLabel('20')
            ->setRequired()
            ->setValue($initialValues['20'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('10');
        $field->setLabel('10')
            ->setRequired()
            ->setValue($initialValues['10'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('5');
        $field->setLabel('5')
            ->setRequired()
            ->setValue($initialValues['5'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('2');
        $field->setLabel('2')
            ->setRequired()
            ->setValue($initialValues['2'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('1');
        $field->setLabel('1')
            ->setRequired()
            ->setValue($initialValues['1'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.5');
        $field->setLabel('0.5')
            ->setRequired()
            ->setValue($initialValues['0.5'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.2');
        $field->setLabel('0.2')
            ->setRequired()
            ->setValue($initialValues['0.2'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.1');
        $field->setLabel('0.1')
            ->setRequired()
            ->setValue($initialValues['0.1'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.05');
        $field->setLabel('0.05')
            ->setRequired()
            ->setValue($initialValues['0.05'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.02');
        $field->setLabel('0.02')
            ->setRequired()
            ->setValue($initialValues['0.02'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.01');
        $field->setLabel('0.01')
            ->setRequired()
            ->setValue($initialValues['0.01'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('Bank Device 1');
        $field->setLabel('Bank Device 1')
            ->setRequired()
            ->setValue($initialValues['Bank Device 1'])
            ->addValidator( new \Zend\Validator\Float() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('Bank Device 2');
        $field->setLabel('Bank Device 2')
            ->setRequired()
            ->setValue($initialValues['Bank Device 2'])
            ->addValidator( new \Zend\Validator\Float() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);


        $field = new Submit('submit');
        $field->setLabel('Submit')
            ->setAttrib('class', 'cash_register')
            ->setDecorators(array(new ButtonDecorator()));
        $this->addElement($field);
    }

}
