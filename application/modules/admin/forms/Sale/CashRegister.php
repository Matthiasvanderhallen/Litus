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
        $field->setLabel('500p')
            ->setRequired()
            ->setValue($initialValues['500p'])
       //     ->addValidator('regex', false, array('/^[0-9]+$/'))
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('200');
        $field->setLabel('200p')
            ->setRequired()
            ->setValue($initialValues['200p'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('100');
        $field->setLabel('100p')
            ->setRequired()
            ->setValue($initialValues['100p'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('50');
        $field->setLabel('50p')
            ->setRequired()
            ->setValue($initialValues['50p'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('20');
        $field->setLabel('20p')
            ->setRequired()
            ->setValue($initialValues['20p'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('10');
        $field->setLabel('10p')
            ->setRequired()
            ->setValue($initialValues['10p'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('5');
        $field->setLabel('5p')
            ->setRequired()
            ->setValue($initialValues['5p'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('2');
        $field->setLabel('2p')
            ->setRequired()
            ->setValue($initialValues['2p'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('1');
        $field->setLabel('1p')
            ->setRequired()
            ->setValue($initialValues['1p'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.5');
        $field->setLabel('0p5')
            ->setRequired()
            ->setValue($initialValues['0p5'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.2');
        $field->setLabel('0p2')
            ->setRequired()
            ->setValue($initialValues['0p2'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.1');
        $field->setLabel('0p1')
            ->setRequired()
            ->setValue($initialValues['0p1'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.05');
        $field->setLabel('0p05')
            ->setRequired()
            ->setValue($initialValues['0p05'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.02');
        $field->setLabel('0p02')
            ->setRequired()
            ->setValue($initialValues['0p02'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('0.01');
        $field->setLabel('0p01')
            ->setRequired()
            ->setValue($initialValues['0p01'])
            ->addValidator( new \Zend\Validator\Int() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('Bank Device 1');
        $field->setLabel('Bank_Device_1')
            ->setRequired()
            ->setValue($initialValues['Bank_Device_1'])
            ->addValidator( new \Zend\Validator\Float() )
            ->setDecorators(array(new FieldDecorator()));
        $this->addElement($field);

        $field = new Text('Bank Device 2');
        $field->setLabel('Bank_Device_2')
            ->setRequired()
            ->setValue($initialValues['Bank_Device_2'])
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
