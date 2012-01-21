<?php

use \Zend\Layout\Layout;

class Bootstrap extends \Zend\Application\Bootstrap
{
    
    protected function _initViewHelper()
    {
        $this->_bootstrap('layout');

        $view = Layout::getMvcInstance()->getView();
        $view->getBroker()
            ->getClassLoader()
            ->registerPlugin('hasaccess', 'Litus\View\Helper\HasAccess')
            ->registerPlugin('request', 'Litus\View\Helper\Request');
    }
}