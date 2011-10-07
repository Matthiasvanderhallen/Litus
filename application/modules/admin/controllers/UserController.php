<?php

namespace Admin;

use \Admin\Form\User\Add as AddForm;
use \Admin\Form\User\Edit as EditForm;

use \Litus\Entity\Users\Credential;
use \Litus\Entity\Users\People\Academic;

class UserController extends \Litus\Controller\Action
{
    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->_forward('add');
    }

    public function addAction()
    {
        $form = new AddForm();

        $this->view->form = $form;
        $this->view->userCreated = false;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {
                $roles = array();

                $formData['roles'][] = 'guest';
                foreach ($formData['roles'] as $role) {
                    $roles[] = $this->getEntityManager()
                        ->getRepository('Litus\Entity\Acl\Role')
                        ->findOneByName($role);
                }

                $newCredential = new Credential(
                    'sha512',
                    $formData['credential']
                );

                $newUser = new Academic(
                    $formData['username'],
                    $newCredential,
                    $roles,
                    $formData['first_name'],
                    $formData['last_name'],
                    $formData['email'],
					$formData['sex']
                );
                $this->getEntityManager()->persist($newUser);

                $this->view->userCreated = true;
                $this->view->form = new AddForm();
            }
        }
    }

    public function manageAction()
    {
        $this->view->paginator = $this->_createPaginator(
            'Litus\Entity\Users\People\Academic',
            array(
                'canLogin' => true
            )
        );
    }

    public function editAction()
    {
        $user = $this->getEntityManager()
            ->getRepository('Litus\Entity\Users\People\Academic')
            ->findOneById($this->getRequest()->getParam('id'));

        $form = new EditForm($user);

        $this->view->form = $form;
        $this->view->userEdited = false;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {
                $roles = array();

                $formData['roles'][] = 'guest';
                foreach ($formData['roles'] as $role) {
                    $roles[] = $this->getEntityManager()
                        ->getRepository('Litus\Entity\Acl\Role')
                        ->findOneByName($role);
                }

                $user->setFirstName($formData['first_name'])
                    ->setLastName($formData['last_name'])
                    ->setEmail($formData['email'])
                    ->setSex($formData['sex'])
                    ->updateRoles($roles);
                
                $this->view->userEdited = true;
            }
        }
    }

    public function deleteAction()
    {
        if (null !== $this->getRequest()->getParam('id')) {
            $user = $this->getEntityManager()
                ->getRepository('Litus\Entity\Users\People\Academic')
                ->findOneById($this->getRequest()->getParam('id'));
        } else {
            $user = null;
        }

        $this->view->userDeleted = false;

        if (null === $this->getRequest()->getParam('confirm')) {
            $this->view->user = $user;
        } else {
            if (1 == $this->getRequest()->getParam('confirm')) {
                $sessions = $this->getEntityManager()
                    ->getRepository('Litus\Entity\Users\Session')
                    ->findByPerson($this->getRequest()->getParam('id'));
                
                foreach ($sessions as $session) {
                    $session->deactivate();
                }
                $user->disableLogin();

                $this->view->userDeleted = true;
            } else {
                $this->_redirect('manage');
            }
        }
    }
}