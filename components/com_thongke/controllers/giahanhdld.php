<?php
/**
 * Author: Phucnh
 * Date created: May 25, 2015
 * Company: DNICT
 * DANH SÁCH GIA HẠN HỢP ĐỒNG LAO ĐỘNG
 */
class ThongkeControllerGiahanhdld extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
		$user = & JFactory::getUser ();
		if ($user->id == null) {
			if (JRequest::getVar('format') == 'raw') {
				echo '<script> window.location.href="index.php?option=com_users&view=login"; </script>';
				exit;
			}else{
				$this->setRedirect ( "index.php?option=com_users&view=login" );
			}
		}
	}
	function display($cachable = false, $urlparams = false) {
		$document   =& JFactory::getDocument();
		$viewName   =	JRequest::getVar( 'view', 'giahanhdld');
		 
		JRequest::setVar('controller','giahanhdld');
		$viewLayout = JRequest::getVar( 'layout', 'default');
		$viewType   = $document->getType();
		$view =& $this->getView( $viewName, $viewType);
		$view->setLayout($viewLayout);
		$view->display();
	}
}
?>