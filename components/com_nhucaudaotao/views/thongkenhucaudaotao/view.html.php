<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class NhucaudaotaoViewThongkenhucaudaotao extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'thongke':
		   		$this->setLayout('default');
		   		$this->thongkenhucau();
		   		break;
		  	default:
		  		$this->setLayout('hoso_404');
  			}
  parent::display($tpl);
 }
 public function thongkenhucau(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript( JURI::base(true).'/media/cbcc/js/caydonvi.js' );
 	$document->addStyleSheet(JUri::base(true).'media/cbcc/js/dataTables-1.10.0/css/jquery.dataTables.min.css');
 	
 	$model = Core::model('Daotao/Thongkenhucaudaotao');
 	$idUser = JFactory::getUser()->id;
 	$idRoot = Core::getManageUnit($idUser, 'com_nhucaudaotao', 'treeview', 'treethongkenhucau');
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