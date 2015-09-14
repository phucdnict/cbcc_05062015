<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class BaocaothongkeViewThongkecanbocongchucpx extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'xuatbaocao':
		  		$this->setLayout('kq');
		  		$this->xuatbaocao();
		  		break;
	  		case "default":
	  			$this->setLayout('default');
	  			$this->dungchung();
	  			$this->khoitao();
	  			break;
  }
  parent::display($tpl);
 }
 public function xuatbaocao(){
 	$donvi_id = $_GET['donvi_id'];
 	$chucdanh = $_GET['chucdanh'];
 	$model = Core::model('Baocaothongke/Thongkecanbocongchucpx');
 	$array_canbo = $model->getAllhosobyDonvi($donvi_id, $chucdanh);
 	$array_chucdanh = $model->getThongtin(array('relation_id, relation_name'), 'config_bc', null, "report_group_code = 'thongkecanbocongchucpx' and relation_id IN (-99,$chucdanh)", '`order` asc');
 	
 	$this->assignRef('array_chucdanh', $array_chucdanh);
 	$this->assignRef('array_canbo', $array_canbo);
 }
 public function dungchung(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.maskedinput.min.js');
 }
 public function khoitao(){
 	$model = Core::model('Baocaothongke/Thongkecanbocongchucpx');
	$model->getRootTree();
	$session = JFactory::getSession();
	$session->set('isRoot',1);
	$chucdanh = $model->_getList_Chucdanh('thongkecanbocongchucpx');
	$this->assignRef('chucdanh', $chucdanh);
	$idRoot = JRequest::getVar('root_id');
	$nameRoot = JRequest::getVar('root_name');
	$root['root_id'] = $idRoot;
	$root['root_name'] = $nameRoot;
 	$this->assignRef('root_info', $root);
 }
}
?>