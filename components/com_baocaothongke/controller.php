<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class BaocaothongkeController extends JControllerLegacy{
	public function __construct(){
		$user  = JFactory::getUser();
		if ((int)$user->id == 0) {
			$msg = "Bạn cần phải Đăng nhập vào hệ thống.";
			$mainframe = JFactory::getApplication();
			$mainframe->redirect(JURI::base(true).'/index.php?option=com_users&view=login', $msg);
		}
		parent::__construct();
	}
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display(){		
		parent::display();
	}
}