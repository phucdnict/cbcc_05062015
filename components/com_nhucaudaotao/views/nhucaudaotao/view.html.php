<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class NhucaudaotaoViewNhucaudaotao extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case "default":
		  		$this->setLayout('default');
		  		$this->dungchung();
		  		$this->canbotonghop();
		  		break;
		   case "nhucaucanhan":
		    	$this->dungchung();
		    	$this->nhucaucanhan();
		    	break;
	    	default:
	    		$this->setLayout('hoso_404');
	    		break;
		   
  }
  parent::display($tpl);
 }
 public function nhucaucanhan(){
 	$hoso = Core::loadAssoc('core_user_hoso', array('hoso_id'), array('user_id = '=>(int)JFactory::getUser()->id));
 	if ((int)$hoso['hoso_id'] >0)  $this->setLayout('nhucaucanhan');
 	else $this->setLayout('hoso_404');
 }
 public function dungchung(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.blockUI.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables.tableTools.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
 	$document->addScript(JUri::base(true).'/components/com_nhucaudaotao/js/bootbox.min.js');
    $document->addScript(JUri::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
 	$document->addStyleSheet(JUri::base(true).'media/cbcc/js/dataTables-1.10.0/css/jquery.dataTables.min.css');
 	$document->addStyleSheet(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
 }
 public function canbotonghop(){
 	$document = JFactory::getDocument();
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript( JURI::base(true).'/media/cbcc/js/caydonvi.js' );
 	$model 	=	Core::model('Daotao/Nhucaudaotao');
 	$idUser = JFactory::getUser()->id;
 	$idRoot = Core::getManageUnit($idUser, 'com_nhucaudaotao', 'treeview', 'treenhucautonghop');
 	if($idRoot == null){
 		$this->setLayout('hoso_404');
 	}else{
 		$root['root_id'] = $idRoot;
 		$tmp= $model->getThongtin(array('name, type'),'ins_dept',null,array('id='.$root['root_id']),null);
 		$root['root_name'] = $tmp[0]->name;
 		$root['root_showlist'] = $tmp[0]->type;
 	}
 	$this->assignRef('root_info', $root);
 }
}

?>