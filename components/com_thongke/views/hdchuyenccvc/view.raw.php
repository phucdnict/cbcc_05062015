<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewHdchuyenccvc extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'dsach_hdchuyenccvc':
		  		$this->dsach_hdchuyenccvc();
		  		break;
  }
  parent::display($tpl);
 }
 public function dsach_hdchuyenccvc(){
 	$model	=	Core::model('Thongke/Thongke');
 	$donvi_id 	=	$_POST['donvi_id'];
 	$ketqua = array();
 	$kq=$model->getDanhsach($donvi_id,'select id from bc_hinhthuc where is_hopdong = 1', '3,2,25');
 	Core::PrintJson($kq);
 	die;
 }
}
?>