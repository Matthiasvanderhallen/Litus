<?php
/**
 * Litus is a project by a group of students from the K.U.Leuven. The goal is to create
 * various applications to support the IT needs of student unions.
 *
 * @author Karsten Daemen <karsten.daemen@litus.cc>
 * @author Bram Gotink <bram.gotink@litus.cc>
 * @author Pieter Maene <pieter.maene@litus.cc>
 * @author Kristof Mariën <kristof.marien@litus.cc>
 * @author Michiel Staessen <michiel.staessen@litus.cc>
 * @author Alan Szepieniec <alan.szepieniec@litus.cc>
 *
 * @license http://litus.cc/LICENSE
 */
 
namespace CudiBundle\Form\Admin\Booking;

use CommonBundle\Component\Form\Admin\Decorator\ButtonDecorator,
	CommonBundle\Component\Form\Admin\Decorator\FieldDecorator,
	CommonBundle\Component\Validator\ValidUsername as UsernameValidator,
	CudiBundle\Component\Validator\ArticleBarcode as ArticleBarcodeValidator,
	CudiBundle\Entity\Sales\BookingStatus,
	Doctrine\ORM\EntityManager,
	Zend\Form\Element\Select,
	Zend\Form\Element\Submit,
	Zend\Form\Element\Text,
	Zend\Form\Form,
	Zend\Form\SubForm,
	Zend\Validator\Int as IntValidator;

/**
 * Add Booking
 *
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class Add extends \CommonBundle\Component\Form\Admin\Form
{
    public function __construct(EntityManager $entityManager, $options = null)
    {
        parent::__construct($options);
         
		$field = new Text('person');
        $field->setLabel('Person')
        	->setRequired()
			->addValidator(new UsernameValidator($entityManager))
        	->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

		$field = new Text('stockArticle');
        $field->setLabel('Article')
            ->setAttrib('class', 'disableEnter')
        	->setRequired()
			->addValidator(new ArticleBarcodeValidator($entityManager))
        	->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

		$field = new Text('number');
        $field->setLabel('Number')
        	->setRequired()
			->addValidator(new IntValidator())
        	->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Submit('submit');
        $field->setLabel('Add')
                ->setAttrib('class', 'bookings_add')
                ->setDecorators(array(new ButtonDecorator()));
        $this->addElement($field);

    }
}