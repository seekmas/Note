<?php
require_once 'Database.php';
class UserController extends Database {
	function init() {
		parent::init ();
		$this->_helper->layout ()->setLayout ( 'user' );
		
		$resp = $this->getResponse ();
		$resp->insert ( 'header', $this->view->render ( 'default/user_header.phtml' ) );
		$resp->insert ( 'footer', $this->view->render ( 'default/user_footer.phtml' ) );
		$resp->insert ( 'helper', $this->view->render ( 'user/signinHelper.phtml' ) );
	}
	function indexAction() {
		if ($this->_request->isPost ()) {
			
			try {
				$u = $this->_request->getParams ();
				$fil = new Zend_Filter_StripTags ();
				$user = array ();
				$user ['userName'] = strtolower ( $fil->filter ( $u ['username'] ) );
				$user ['userPass'] = $fil->filter ( $u ['userpass'] );
				
				$auth = Zend_Registry::get ( 'authAdapter' );
				
				$auth->setTablename ( 'note_user' )->setIdentityColumn ( 'userName' )->setCredentialColumn ( 'userPass' )->setIdentity ( $user ['userName'] )->setCredential ( $user ['userPass'] )->authenticate ();
				$signup = $auth->getResultRowObject ();
				if (is_object ( $signup )) {
					
					//
				}
			} catch ( Exception $e ) {
				echo $e->getMessage ();
			}
		}
	}
	function signupAction() {
		$resp = $this->getResponse ();
		$resp->insert ( 'helper', $this->view->render ( 'user/signupHelper.phtml' ) );
	}
}