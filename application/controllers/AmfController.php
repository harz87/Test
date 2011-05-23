<?php

class AmfController extends Zend_Controller_Action
{
	public function indexAction(){
		$this->_helper->viewRenderer->setNoRender();
		$server = new Zend_Amf_Server();
		$server->addDirectory(APPLICATION_PATH.'/services/');
		$server->setProduction(FALSE);
		echo $server->handle();
	}
}
?>