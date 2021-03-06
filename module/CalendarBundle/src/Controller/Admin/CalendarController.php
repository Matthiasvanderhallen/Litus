<?php

namespace CalendarBundle\Controller\Admin;

use CommonBundle\Component\FlashMessenger\FlashMessage,
    CalendarBundle\Entity\Nodes\Event,
    CalendarBundle\Entity\Nodes\Translation,
    CalendarBundle\Form\Admin\Event\Add as AddForm,
    CalendarBundle\Form\Admin\Event\Edit as EditForm,
    DateTime;

/**
 * Handles system admin for calendar.
 *
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class CalendarController extends \CommonBundle\Component\Controller\ActionController
{
    public function manageAction()
    {
        $paginator = $this->paginator()->createFromArray(
            $this->getEntityManager()
                ->getRepository('CalendarBundle\Entity\Nodes\Event')
                ->findAll(),
            $this->getParam('page')
        );
        
        return array(
        	'paginator' => $paginator,
        	'paginationControl' => $this->paginator()->createControl(),
        );
    }
    
    public function addAction()
    {
        $form = new AddForm($this->getEntityManager());
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->post()->toArray();
        	
            if ($form->isValid($formData)) {
                $event = new Event(
                    $this->getAuthentication()->getPersonObject(),
                    DateTime::createFromFormat('d/m/Y H:i', $formData['start_date']),
                    DateTime::createFromFormat('d/m/Y H:i',$formData['end_date'])
                );
                $this->getEntityManager()->persist($event);

                $languages = $this->getEntityManager()
                    ->getRepository('CommonBundle\Entity\General\Language')
                    ->findAll();
                
                foreach($languages as $language) {
                    $translation = new Translation(
                        $event,
                        $language,
                        $formData['location_' . $language->getAbbrev()],
                        $formData['title_' . $language->getAbbrev()],
                        $formData['content_' . $language->getAbbrev()]
                    );
                    $this->getEntityManager()->persist($translation);
                    
                    if ($language->getAbbrev() == 'en')
                        $title = $formData['title_' . $language->getAbbrev()];
                }

                $this->getEntityManager()->flush();
                
                \CommonBundle\Component\Log\Log::createLog(
                    $this->getEntityManager(),
                    'action',
                    $this->getAuthentication()->getPersonObject(),
                    'Event added: ' . $title
                );
                
                $this->flashMessenger()->addMessage(
                    new FlashMessage(
                        FlashMessage::SUCCESS,
                        'Succes',
                        'The event was successfully added!'
                    )
                );

                $this->redirect()->toRoute(
                	'admin_calendar',
                	array(
                		'action' => 'manage'
                	)
                );
                
                return;
            }
        }
        
        return array(
            'form' => $form,
        );
    }
    
    public function editAction()
    {
        if (!($event = $this->_getEvent()))
            return;
        
        $form = new EditForm($this->getEntityManager(), $event);
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->post()->toArray();
        	
            if ($form->isValid($formData)) {
                $event->setUpdatePerson($this->getAuthentication()->getPersonObject())
                    ->setStartDate(DateTime::createFromFormat('d/m/Y H:i', $formData['start_date']))
                    ->setEndDate(DateTime::createFromFormat('d/m/Y H:i', $formData['end_date']));

                $languages = $this->getEntityManager()
                    ->getRepository('CommonBundle\Entity\General\Language')
                    ->findAll();
                
                foreach($languages as $language) {
                    $translation = $event->getTranslation($language);
                    
                    if ($translation) {
                        $translation->setLocation($formData['location_' . $language->getAbbrev()])
                            ->setTitle($formData['title_' . $language->getAbbrev()])
                            ->setContent($formData['content_' . $language->getAbbrev()]);
                    } else {
                        $translation = new Translation(
                            $event,
                            $language,
                            $formData['location_' . $language->getAbbrev()],
                            $formData['title_' . $language->getAbbrev()],
                            $formData['content_' . $language->getAbbrev()]
                        );
                        $this->getEntityManager()->persist($translation);
                    }
                    
                    if ($language->getAbbrev() == 'en')
                        $title = $formData['title_' . $language->getAbbrev()];
                }

                $this->getEntityManager()->flush();
                
                \CommonBundle\Component\Log\Log::createLog(
                    $this->getEntityManager(),
                    'action',
                    $this->getAuthentication()->getPersonObject(),
                    'Event edited: ' . $title
                );
                
                $this->flashMessenger()->addMessage(
                    new FlashMessage(
                        FlashMessage::SUCCESS,
                        'Succes',
                        'The event was successfully edited!'
                    )
                );

                $this->redirect()->toRoute(
                	'admin_calendar',
                	array(
                		'action' => 'manage'
                	)
                );
                
                return;
            }
        }
        
        return array(
            'form' => $form,
        );
    }
    
    public function deleteAction()
    {
        $this->initAjax();
        
        if (!($event = $this->_getEvent()))
            return;
        
        $this->getEntityManager()->remove($event);
        
        $this->getEntityManager()->flush();
        
        \CommonBundle\Component\Log\Log::createLog(
            $this->getEntityManager(),
            'action',
            $this->getAuthentication()->getPersonObject(),
            'Event deleted: ' . $event->getTitle(
                $this->getEntityManager()
                    ->getRepository('CommonBundle\Entity\General\Language')
                    ->findOneByAbbrev('en')
                )
        );
    	
    	return array(
    		'result' => array(
    			'status' => 'success'
    		),
    	);
    }
    
    public function _getEvent()
    {
    	if (null === $this->getParam('id')) {
    		$this->flashMessenger()->addMessage(
    		    new FlashMessage(
    		        FlashMessage::ERROR,
    		        'Error',
    		        'No id was given to identify the event!'
    		    )
    		);
    		
    		$this->redirect()->toRoute(
    			'admin_calendar',
    			array(
    				'action' => 'manage'
    			)
    		);
    		
    		return;
    	}
    
        $event = $this->getEntityManager()
            ->getRepository('CalendarBundle\Entity\Nodes\Event')
            ->findOneById($this->getParam('id'));
    	
    	if (null === $event) {
    		$this->flashMessenger()->addMessage(
    		    new FlashMessage(
    		        FlashMessage::ERROR,
    		        'Error',
    		        'No event with the given id was found!'
    		    )
    		);
    		
    		$this->redirect()->toRoute(
    			'admin_calendar',
    			array(
    				'action' => 'manage'
    			)
    		);
    		
    		return;
    	}
    	
    	return $event;
    }
}