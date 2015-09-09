<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 * DANH SÁCH TUYỂN DỤNG
 */
class ThongkeControllerTuyendung extends JControllerLegacy {
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
		$viewName   =	JRequest::getVar( 'view', 'tuyendung');
		JRequest::setVar('controller','tuyendung');
		$viewLayout = JRequest::getVar( 'layout', 'default');
		$viewType   = $document->getType();
		$view =& $this->getView( $viewName, $viewType);
		$view->setLayout($viewLayout);
		$view->display();
	}
}
?>