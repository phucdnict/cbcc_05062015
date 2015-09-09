<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewBcdaotaovc extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'doituong':
		  		$this->doituong();
		  		break;
		  		case "default":
		  			$this->setLayout('default');
		  			$this->dungchung();
		  			$this->baocao();
		  			break;
  }
  parent::display($tpl);
 }
 public function doituong(){
 	$model			=	Core::model('Thongke/Bcdaotaoboiduong');
 	$donvi_id 	=	$_POST['donvi_id'];
 	$tungay 		=	$_POST['tungay_bcdaotaovc'];
 	$denngay 		=	$_POST['denngay_bcdaotaovc'];
 	$target			=	$_POST['target'];
 	$condition		=	$_POST['condition'];
 	$json 			=	$model->hienthiBaocao($donvi_id, $target, $condition,$tungay, $denngay);
 	Core::PrintJson($json);
 	die;
 }
 public function dungchung(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.maskedinput.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/dataTables.tableTools.min.js');
 	$document->addStyleSheet(JUri::base(true).'media/cbcc/js/dataTables-1.10.0/css/jquery.dataTables.min.css');
 	$document->addStyleSheet(JUri::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
 }
 public function baocao(){
 	$document = JFactory::getDocument();
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript( JURI::base(true).'/media/cbcc/js/caydonvi.js' );
 	$model 	=	Core::model('Thongke/Bcdaotaoboiduong');
 	$idUser = JFactory::getUser()->id;
 	$idRoot = Core::getManageUnit($idUser, 'com_thongke', 'treeview', 'treebcdaotaovc');
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