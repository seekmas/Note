<?php
require_once 'Database.php';
require_once 'Zend/Date.php';
require_once 'KeepData.php';
require_once 'Zend/XmlRpc/Server.php';
require_once 'Zend/XmlRpc/Client.php';
require_once APPLICATION_PATH . '/models/record.php';
require_once APPLICATION_PATH . '/models/mark.php';

/*
 *
 */
class IndexController extends Database {
	public function init() {
		parent::init ();
		$resp = $this->getResponse ();
		$resp->insert ( 'header', $this->view->render ( 'default/header.phtml' ) );
		$resp->insert ( 'footer', $this->view->render ( 'default/footer.phtml' ) );
	}
	public function indexAction() {
		$this->view->var = Zend_Date::now()->toArray();
	}
	public function recordAction() {
		if ($this->_request->isPost ()) {
			$filter = new Zend_Filter_StripTags ();
			
			$p = $this->_request->getParams ();
			$p ['userId'] = 1;
			$post = array (
					'userId' => $p ['userId'],
					'recordIntro' => $filter->filter ( $p ['recordIntro'] ),
					'recordContent' => $filter->filter ( $p ['recordContent'] ),
					'recordDate' => $p ['recordDate'] 
			);
			
			$record = new recordModel ();
			
			$this->view->record = $record->addRecord ( $post );
		}
	}
	public function listAction() {
		$record = new recordModel ();
		
		$this->view->columnList = $record->getRecord ();
	}
	
	public function serviceAction()
	{
		$sv = new Zend_XmlRpc_Server();
		$sv->setClass('KeepData');
		echo $sv->handle();
	}
	
	public function clientAction()
	{
		try{
		$cl = new Zend_XmlRpc_Client('http://localhost:8888/Note/public/index/service');
		echo $cl->call('say');
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function demoAction()
	{
		$figlet = new Zend_Text_Figlet( array('outputWidth' => '140'));
		
		echo '<pre>';
		echo $figlet->render( 'Welcome to note');
		echo '</pre>';
	}
}

