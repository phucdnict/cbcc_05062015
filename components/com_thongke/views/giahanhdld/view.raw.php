<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewGiahanhdld extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'dsach_giahanhdld':
		  		$this->_dsach_giahanhdld();
		  		break;
  }
  parent::display($tpl);
 }
 public function _dsach_giahanhdld(){
 	$model			=	Core::model('Thongke/Thongke');
 	$donvi_id 	=	$_POST['donvi_id'];
 	$json 			=	$model->getGiahanhdld($donvi_id, 'select id from bc_hinhthuc where is_hopdong = 1');
 	Core::PrintJson($json);
 	die;
 }
}
?>