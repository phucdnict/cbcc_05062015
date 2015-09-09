<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewTuyendung extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	case 'dsach_tuyendung':
		  		$this->dsach_tuyendung();
		  		break;
  }
  parent::display($tpl);
 }
 public function dsach_tuyendung(){
 	$model	=	Core::model('Thongke/Thongke');
 		$donvi_id 	=	$_POST['donvi_id'];
 		$ketqua = array();
		$kq=$model->getThongtin('qtht.hosochinh_id as id, qtht.ngaysinh, qtht.hoten as e_name, qtht.congtac_chucvu, phong.name as congtac_phong, qtht.luong_ngaybatdau, qtht.luong_tenngach, qtht.luong_mangach, qtht.luong_bac, qtht.luong_heso',
				'hosochinh_quatrinhhientai qtht',array('inner'=>'ins_dept dv on dv.id = qtht.congtac_donvi_id', 'inner '=>'ins_dept phong on phong.id = qtht.congtac_phong_id'),
				 'dv.ins_loaihinh =1 and qtht.hoso_trangthai="00" and qtht.luong_hinhthuc_id = 9 and dv.id = '.$donvi_id, null);
		Core::PrintJson($kq);
 		die;
 }
}
?>