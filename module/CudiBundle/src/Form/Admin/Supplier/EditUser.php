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
 
namespace CudiBundle\Form\Admin\Supplier;

use CommonBundle\Component\Form\Admin\Decorator\ButtonDecorator,
	CommonBundle\Component\Form\Admin\Decorator\FieldDecorator,
	CommonBundle\Entity\Users\Person,
	Doctrine\ORM\EntityManager,
	Zend\Form\Element\Select,
	Zend\Form\Element\Submit;

/**
 * Edit a user's data.
 *
 * @author Pieter Maene <pieter.maene@litus.cc>
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class EditUser extends \CommonBundle\Form\Admin\Person\Edit
{	
	/**
	 * @param \Doctrine\ORM\EntityManager $entityManager The EntityManager instance
	 * @param \CommonBundle\Entity\Users\Person $person The person we're going to modify
	 * @param mixed $opts The validator's options
	 */
    public function __construct(EntityManager $entityManager, Person $person, $opts = null)
    {
        parent::__construct($entityManager, $person, $opts);
        
        $this->removeElement('roles');
        
        $field = new Submit('submit');
        $field->setLabel('Save')
            ->setAttrib('class', 'supplier_edit')
            ->setDecorators(array(new ButtonDecorator()));
        $this->addElement($field);
    }
}