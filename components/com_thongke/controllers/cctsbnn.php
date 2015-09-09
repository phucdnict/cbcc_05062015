<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 * CÔNG CHỨC TẬP SỰ BỔ NHIỆM NGẠCH
 */
class ThongkeControllerCctsbnn extends JControllerLegacy {
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
		$viewName   =	JRequest::getVar( 'view', 'cctsbnn');
		JRequest::setVar('controller','cctsbnn');
		$viewLayout = JRequest::getVar( 'layout', 'default');
		$viewType   = $document->getType();
		$view =& $this->getView( $viewName, $viewType);
		$view->setLayout($viewLayout);
		$view->display();
	}
}
?>