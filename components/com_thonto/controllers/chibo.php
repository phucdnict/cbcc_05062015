<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 * Chi bộ
 */
class ThontosControllerChibo extends ThontosController {
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
		$document    =& JFactory::getDocument();
        $viewName    = JRequest::getVar( 'view', 'chibo');
        $viewLayout = JRequest::getVar( 'layout', 'default');
        $viewType   = $document->getType();    
        $view =& $this->getView( $viewName, $viewType);
        $view->setLayout($viewLayout);		
        $view->display(); 	
	}
	function luuchibo(){
		$form_chibo = $_POST;
		$values = array();
		parse_str($form_chibo['form_chibo'], $values);
		$model = Core::model('Thonto/Chibo');
		return Core::PrintJson($model->savechibo($values));
	}
	public function xoachibo(){
		$id = JRequest::getInt('idchibo',null);
		$model = Core::model('Thonto/Chibo');
		Core::PrintJson ($model->xoachibo($id));
	}
}
?>