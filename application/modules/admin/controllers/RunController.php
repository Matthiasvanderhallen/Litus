<?php

namespace Admin;

use \Admin\Form\Auth\Login as LoginForm;

use \Zend\Dom\Query;
use \Zend\Json\Json;

class RunController extends \Litus\Controller\Action
{
	private $currentLap = null;
    private $nextLap = null;

	public function init()
	{
		parent::init();

        $this->currentLap = $this->getEntityManager()
            ->getRepository('Litus\Entity\Sport\Lap')
            ->findCurrent();
        $this->nextLap = $this->getEntityManager()
            ->getRepository('Litus\Entity\Sport\Lap')
            ->findNext();
	}
	
	public function indexAction()
	{
		$this->_forward('queue');
	}
	
	public function queueAction()
	{
        $this->view->currentLap = $this->currentLap;
        $this->view->nextLap = $this->nextLap;

        $this->view->previousLaps = $this->getEntityManager()
            ->getRepository('Litus\Entity\Sport\Lap')
            ->findPrevious(5);
        $this->view->nextLaps = $this->getEntityManager()
            ->getRepository('Litus\Entity\Sport\Lap')
            ->findNext(15);

        $this->view->nbLaps = $this->getEntityManager()
            ->getRepository('Litus\Entity\Sport\Lap')
            ->countAll();

        $teamNumber = $this->getEntityManager()
            ->getRepository('Litus\Entity\Config\Config')
            ->findOneByKey('sport.24h_team_number')
            ->getValue();

        $domQuery = new Query(
            file_get_contents('http://media.24u.ulyssis.org/live/tussenstand.html')
        );

        $this->view->nbOfficialLaps = $domQuery->execute('#team' . $teamNumber . ' .teamlaps')
            ->current()
            ->childNodes
            ->item(0)
            ->wholeText;
	}

    public function deleteAction()
    {
        $lap = $this->getEntityManager()
            ->getRepository('Litus\Entity\Sport\Lap')
            ->findOneById($this->getRequest()->getParam('id'));

        $this->view->lapDeleted = false;

        if (null === $this->getRequest()->getParam('confirm')) {
            $this->view->lap = $lap;
        } else {
            if (1 == $this->getRequest()->getParam('confirm')) {
                $this->getEntityManager()->remove($lap);
                $this->view->lapDeleted = true;
            } else {
                $this->_redirect('queue');
            }
        }
    }

    public function startAction()
    {
        $this->broker('viewRenderer')->setNoRender();

        if (null !== $this->nextLap)
            $this->nextLap->start();
        
        $this->_redirect('queue');
    }

    public function groupsAction()
    {

    }
}