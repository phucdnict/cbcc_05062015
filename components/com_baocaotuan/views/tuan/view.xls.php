<?php
/**
 * Author: Phucnh
* Date created: May 25, 2015
* Company: DNICT
*/
defined('_JEXEC') or die();
require 'libraries/phpexcel/Classes/PHPExcel.php';
class BaocaotuanViewTuan extends JViewLegacy
{   
  function __construct()
  { 
  	parent::__construct();
  }
  function unique_obj($obj) {
  	static $idList = array();
  	if(in_array($obj->id,$idList)) {
  		return false;
  	}
  	$idList []= $obj->id;
  	return true;
  }
  function display($tpl = null)
   { 
    $objPhpExcel = new PHPExcel();
    $data = JRequest::get('donvi_id');
    $user = JFactory::getUser();
    $user_id = $user->id;
    $model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
    if ($data['task'] == "excelbctuan"){
    	$baocao_id = $data['baocao_id'];
		$ketqua = $model->getThongtin('ju.name as tennhanvien, bc.*', 'zxbaocao bc', array('inner'=>'jos_users ju on ju.id = bc.user_id'), 'bc.trangthai = 1 and bc.user_id = '.$user_id.' and bc.id IN ('.$baocao_id.')', 'batdau asc, ketthuc asc' );
    	$this->assignRef('rows', $ketqua);
    	if(is_null($tpl)) $tpl = 'excel_baocaotuan';
   	}
    if ($data['task'] == "excellamthemgio"){
    	$lamthemgio_id = $data['lamthemgio_id'];
		$thongtin_all = $model->getThongtin('ju.name as tennhanvien, DATE_FORMAT(ltg.timebatdau,"%Hh%i") as timebatdau, DATE_FORMAT(ltg.timeketthuc,"%Hh%i") as timeketthuc,ltg.thoigian,ltg.congvieclamthem as congvieclamthem, DATE_FORMAT(ltg.ngaylamthem,"%d/%m/%Y") as ngaylamthem, DATE_FORMAT(ltg.ngaylamthem,"%m") as thanglamthem, DATE_FORMAT(ltg.ngaylamthem,"%Y") as namlamthem', 'zxlamthemgio ltg', array('inner'=>'jos_users ju on ju.id = ltg.user_id'), ' ltg.user_id = '.$user_id.' and ltg.id IN ('.$lamthemgio_id.')', ' ngaylamthem asc' );
		$thanglamthem = $model->getThongtin('distinct(DATE_FORMAT(ltg.ngaylamthem,"%m")) as thanglamthem', 'zxlamthemgio ltg', null, ' ltg.user_id = '.$user_id.' and ltg.id IN ('.$lamthemgio_id.')', ' ngaylamthem asc');
		$ketqua = array();
		for($i=0; $i<count($thanglamthem);$i++){
			for($j=0; $j< count($thongtin_all); $j++){
				if( $thanglamthem[$i]->thanglamthem == $thongtin_all[$j]->thanglamthem)
					$ketqua[$thanglamthem[$i]->thanglamthem][] = $thongtin_all[$j];
			}
		}
    	$this->assignRef('rows', $ketqua);
    	if(is_null($tpl)) $tpl = 'excel_lamthemgio';
   	}
    parent::display($tpl);
  }
}