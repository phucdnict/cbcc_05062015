<?php
class TochucControllerSearch extends  JControllerLegacy{
	function __construct($config = array()) {
		parent::__construct ( $config );
		$user = & JFactory::getUser ();
		if ($user->id == null) {
			//var_dump(JRequest::getVar('format'));exit;
			if (JRequest::getVar('format') == 'raw') {
				echo '<script> window.location.href="index.php?option=com_users&view=login"; </script>';
				exit;
			}else{
				$this->setRedirect ( "index.php?option=com_users&view=login" );
			}
		}
	}
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'search');
		// Get some vars for the view
		$viewLayout = JRequest::getVar( 'layout', 'default');
		$viewType   = $document->getType();
		// Get the view
		$view =& $this->getView( $viewName, $viewType);
		// Set the layout
		$view->setLayout($viewLayout);
		$view->display();
	}
	public function dosearch(){
		$formData = JRequest::get('post');
		//var_dump($formData);
		$model = Core::model('Tochuc/InsDept');
		$items = $model->search($formData,null,null,null);
		Core::printJson($items);
		//var_dump($items);
		//exit;
	}
	public function getTypeLinhvuc(){
		$formData = JRequest::get('post');
		$linhvuc	=	$formData['linhvuc'];
		$model = Core::model('Tochuc/InsDept');
		if ($linhvuc == 1 || $linhvuc ==3) $type = 2; // tổ chức/tổ chức hoạt động như phòng
		elseif($linhvuc==0) $type= 1; // phòng
		elseif($linhvuc==2) exit;
		$items = $model->getThongtin('id,name,level','cb_type_linhvuc',null, array('type='.$type), 'lft asc');
		Core::printJson($items);
		//var_dump($items);
		//exit;
	}
}