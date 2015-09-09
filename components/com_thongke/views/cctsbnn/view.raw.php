<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewCctsbnn extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'dsach_cctsbnn':
		  		$this->dsach_cctsbnn();
		  		break;
		  		case "default":
		  			$this->setLayout('default');
		  			$this->dungchung();
		  			break;
  }
  parent::display($tpl);
 }
 public function dsach_cctsbnn(){
 	$model	=	Core::model('Thongke/Thongke');
 		$donvi_id 	=	$_POST['donvi_id'];
 		$ketqua = array();
		$kq=$model->getDanhsach($donvi_id,Core::config('cbcc/bienche/tapsu'), '3,2,25');
		Core::PrintJson($kq);
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
}
?>