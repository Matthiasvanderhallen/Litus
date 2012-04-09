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
 
namespace CommonBundle\Form\Admin\Academic;

use CommonBundle\Component\Form\Admin\Decorator\ButtonDecorator,
	CommonBundle\Component\Form\Admin\Decorator\FieldDecorator,
	Doctrine\ORM\EntityManager,
	Zend\Form\Element\Submit,
	Zend\Form\Element\Text,
	Zend\Validator\Alnum as AlnumValidator;

/**
 * Add a user to the database.
 *
 * @author Pieter Maene <pieter.maene@litus.cc>
 */
class Add extends \CommonBundle\Form\Admin\Person\Add
{
	/**
	 * @param \Doctrine\ORM\EntityManager $entityManager The EntityManager instance
	 * @param mixed $opts The validator's options
	 */
    public function __construct(EntityManager $entityManager, $opts = null)
    {
        parent::__construct($entityManager, $opts);
		        
        $field = new Text('university_identification');
        $field->setLabel('University Identification')
        	->setRequired()
            ->setDecorators(array(new FieldDecorator()))
            ->addValidator(new AlnumValidator());
        $this->addElement($field);

        $field = new Submit('submit');
        $field->setLabel('Add')
            ->setAttrib('class', 'academic_add')
            ->setDecorators(array(new ButtonDecorator()));
        $this->addElement($field);
    }
}
