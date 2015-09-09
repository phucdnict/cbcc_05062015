<?php
/**
 * Author: Phucnh
 * Date created: Apr 04, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class BaocaotuanViewTuan extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'form':
	  			$this->setLayout('addtuan');
	  			$this->addtuan();
	  			break;
	  		case 'addlamthemgio':
	  			$this->setLayout('addlamthemgio');
	  			$this->addlamthemgio();
	  			break;
	  		case 'quatrinh':
	  			$this->setLayout('quatrinh');
	  			break;
	  		case 'addupload':
	  			$this->setLayout('upload');
	  			break;
  			case 'lamthemgio':
  				$this->setLayout('lamthemgio');
  				break;
	  		case 'getquatrinh':
	  			$this->getquatrinh();
	  			break;
	  		case 'getlamthemgio':
	  			$this->getlamthemgio();
	  			break;
	  		case 'gettencongviec':
	  			$this->gettencongviec();
	  			break;
	  	}
	  	parent::display($tpl);
	 }
	 private function addtuan(){
	 	$id = JRequest::getInt('id');
	 	$model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
	 	$data = $model->getThongtin('*','zxbaocao',null, ' id = '.$id.'',null);
	 	$maduan = $data[0]->maduan;
	 	$cbo_maduan = $model->getCbo('zxduan','id, tenduan', ' trangthai = 1', 'sapxep asc', '-Chọn dự án-', 'id', 'tenduan', $maduan, 'maduan', null, null);
	 	$this->assignRef('maduan', $cbo_maduan);
	 	$this->assignRef('row', $data);
	 }
	 private function gettencongviec(){
	 	$ngaylamthem = JRequest::getVar('ngaylamthem');
	 	$date = date_create($ngaylamthem);
		date_add($date, date_interval_create_from_date_string('-7 days'));
		$d1=date_format($date, 'Y-m-d');
		date_add($date, date_interval_create_from_date_string('+14 days'));
		$d2=date_format($date, 'Y-m-d');
	 	$model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
	 	$user   = JFactory::getUser();
	 	$user_id = $user->id;
	 	$cbo_tencv = $model->getCbo('zxbaocao','id, congviec', ' trangthai = 1 and user_id = '.$user_id.' and batdau>="'.$d1.'" and ketthuc<="'.$d2.'"', 'batdau asc', '-Chọn công việc-', 'id', 'congviec', $maduan, 'cbo_tencv', 'chosen', 'id asc');
	 	Core::PrintJson($cbo_tencv);
	 	die;
	 }
	 private function getquatrinh(){
	 	$user_id = $_POST['user_id'];
	 	$bcbatdau = $_POST['bcbatdau'];
	 	$bcketthuc =$_POST['bcketthuc'];
	 	$model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
	 	$quatrinh = $model->getThongtin('*','zxbaocao',null, 'trangthai=1 and user_id = '.$user_id.' and (batdau<="'.$bcketthuc.'" and  ketthuc>="'.$bcbatdau.'")'
	 			,'batdau asc, ketthuc asc');
	 	Core::PrintJson($quatrinh);
	 	die;
	 }
	 private function getlamthemgio(){
	 	$user_id = $_POST['user_id'];
	 	$lamthemgiobatdau = $_POST['lamthemgiobatdau'];
	 	$lamthemgioketthuc =$_POST['lamthemgioketthuc'];
	 	$model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
	 	$quatrinh = $model->getThongtin('DATE_FORMAT(ltg.timebatdau,"%Hh%i") as timebatdau, DATE_FORMAT(ltg.timeketthuc,"%Hh%i") as timeketthuc,ltg.thoigian,ltg.congvieclamthem as congvieclamthem, ltg.ngaylamthem, DATE_FORMAT(ltg.ngaylamthem,"%m") as thanglamthem, DATE_FORMAT(ltg.ngaylamthem,"%Y") as namlamthem, ltg.id','zxlamthemgio ltg',null, ' user_id = '.$user_id.' and (ngaylamthem<="'.$lamthemgioketthuc.'" and  ngaylamthem>="'.$lamthemgiobatdau.'")','ngaylamthem asc');
	 	Core::PrintJson($quatrinh);
	 	die;
	 }
	 private function addlamthemgio(){
	 	$id = JRequest::getInt('id');
	 	$user   = JFactory::getUser();
	 	$user_id = $user->id;
	 	$model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
	 	$data = $model->getThongtin('*','zxlamthemgio',null, ' id = '.$id.'',null);
// 	 	$maduan = $data[0]->maduan;
// 	 	$cbo_tencv = $model->getCbo('zxbaocao','id, congviec', ' trangthai = 1 and user_id = '.$user_id.' and batdau>="'.$d1.'" and ketthuc<="'.$d2.'"', 'batdau asc', '-Chọn công việc-', 'id', 'congviec', $maduan, 'cbo_tencv', 'chosen', null);
	 	$this->assignRef('row', $data);
	 }
}
?>