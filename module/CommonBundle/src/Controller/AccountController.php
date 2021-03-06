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

namespace CommonBundle\Controller;

use CommonBundle\Component\FlashMessenger\FlashMessage,
    CommonBundle\Entity\Users\Credential,
    CommonBundle\Form\Auth\Activate as ActivateForm;

/**
 * Handles account page.
 *
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class AccountController extends \CommonBundle\Component\Controller\ActionController
{
    public function indexAction()
    {
    
    }
    
    public function activateAction()
    {
        if (!($user = $this->_getUser()))
            return;
        
        $form = new ActivateForm();
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->post()->toArray();
        	
            if ($form->isValid($formData)) {
                $user->setCode(null)
                    ->setCredential(
                        new Credential(
                            'sha512',
                            $formData['credential']
                        )
                    );
                
                $this->getEntityManager()->flush();
                
                $this->flashMessenger()->addMessage(
                    new FlashMessage(
                        FlashMessage::SUCCESS,
                        'Success',
                        'Your account is succesfully activated'
                    )
                );
                
                $this->redirect()->toRoute(
                	'home'
                );
                
                return;
            }
        }
        
        return array(
            'form' => $form,
        );
        // check if code exists
        // show field to enter new password
        // on post: save new password, set code = null
    }
    
    public function _getUser()
    {
    	if (null === $this->getParam('id')) {
    		$this->flashMessenger()->addMessage(
    		    new FlashMessage(
    		        FlashMessage::ERROR,
    		        'Error',
    		        'No code was given to identify the user!'
    		    )
    		);
    		
    		$this->redirect()->toRoute(
    			'home'
    		);
    		
    		return;
    	}
    
        $user = $this->getEntityManager()
            ->getRepository('CommonBundle\Entity\Users\Code')
            ->findOneUserByCode($this->getParam('id'));
    	
    	if (null === $user) {
    		$this->flashMessenger()->addMessage(
    		    new FlashMessage(
    		        FlashMessage::ERROR,
    		        'Error',
    		        'No user with the given name was code!'
    		    )
    		);
    		
    		$this->redirect()->toRoute(
    			'home'
    		);
    		
    		return;
    	}
    	
    	return $user;
    }
}