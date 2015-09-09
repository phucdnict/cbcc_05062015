<?php
/**
 * Author: Phucnh
 * Date created: Apr 04, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewTochuc extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'detail':
	  			$this->setLayout('detail');
	  			$this->detail();
	  			break;
  			case 'editvochua':
  				$this->setLayout('editvochua');
  				$this->edit();
  				break;
  			case 'editphuongxa':
  				$this->setLayout('editphuongxa');
  				$this->edit();
  				break;
  			case 'editthonto':
  				$this->setLayout('editthonto');
  				$this->edit();
  				break;
  			case 'getchibo':
  				$this->getchibo();
  			case 'gethoso':
  				$this->gethoso();
  				break;
  			case 'gethosoquanly':
  				$this->gethosoquanly();
  				break;
  			case 'checkhoso':
  				$this->checkhoso();
  				break;
  			case 'soluongkhongchuyentrach':
  				$this->setLayout('editsoluongkhongchuyentrach');
  				$this->soluongkhongchuyentrach();
  				break;
	  	}
	  	parent::display($tpl);
	 }
	 function checkhoso(){
	 	$id = (int)$_GET['id'];
	 	$model = Core::model('Thonto/Tochuc');
	 	$row = $model->getThongtin(array('count(hs.hosochinh_id) as sl'),'thonto_hosocanbo hs', array('inner'=>'(SELECT distinct(node.id) FROM thonto_tochuc AS node, thonto_tochuc AS parent
					  WHERE node.lft BETWEEN parent.lft AND parent.rgt AND  parent.id ='.$id.') as dvc ON dvc.id = hs.congtac_donvi_id  '), null, null);
	 	$data = $row[0]->sl >0? false: true;
	 	Core::PrintJson($data);
	 }
	 function getchibo(){
	 	$px_id = (int)$_GET['px'];
	 	$model = Core::model('Thonto/Tochuc');
	 	Core::PrintJson($model->getCbo('thonto_chibo','id, ten','donvi_id='.$px_id,'ten asc', '','-- Chọn chi bộ --','id','ten', null,'chibo_id',''));
	 } 
	 function gethoso(){
	 	$px_id = (int)$_GET['px_id'];
	 	$model = Core::model('Thonto/Tochuc');
	 	Core::PrintJson($model->getCbo('hosochinh_quatrinhhientai','hosochinh_id, hoten','hoso_trangthai ="00" and congtac_donvi_id='.$px_id,'hoten asc', '','-- Chọn cán bộ quản lý --','hosochinh_id','hoten', null,'hosochinh_id',''));
	 } 
	 function gethosoquanly(){
	 	$px_id = (int)$_GET['px_id'];
	 	$model = Core::model('Thonto/Tochuc');
	 	$row = $model->getThongtin(array('hosochinh_id'),'thonto_tochuc', null, array('donvi_id='.$px_id), null);
	 	Core::PrintJson($row[0]->hosochinh_id);
	 } 
	 function soluongkhongchuyentrach(){
	 	$thonto_id = JRequest::getInt( 'id', 0);
	 	$model = Core::model('Thonto/Tochuc');
	 	$row_soluongkhongchuyentrach = $model->getThongtin('cb.*', 'thonto_canbochuyentrach cb', null, 'cb.thonto_id='.$thonto_id, null);
	 	$this->assignRef('row', $row_soluongkhongchuyentrach[0]);
	 }
	 function detail(){
	 	$thonto_id = JRequest::getInt( 'id', 0);
	 	$model = Core::model('Thonto/Tochuc');
	 	$detail = $model->getThongtin('tc.*, px.name as tenpx, cb.ten as tenchibo, nvc.ten as tenloaihinhtochuc,hsc.e_name as tencanbo ', 'thonto_tochuc tc', array('left'=>'ins_dept px on px.id=tc.donvi_id', 'left  '=>'thonto_chibo cb ON cb.id=tc.chibo_id', 'left '=>'thonto_loaihinhtochuc nvc ON nvc.id=tc.kieu', 'left    ' =>'hosochinh hsc ON hsc.id = tc.hosochinh_id'), 'tc.id='.$thonto_id, null);
	 	$row_soluongkhongchuyentrach = $model->getThongtin('cb.*', 'thonto_canbochuyentrach cb', null, 'cb.thonto_id='.$thonto_id, null);
	 	$this->assignRef('row_soluongkhongchuyentrach', $row_soluongkhongchuyentrach[0]);
	 	$this->assignRef('row', $detail[0]);
	 }
	 function edit(){
	 	$id = $_GET['id']==null ? '0':$_GET['id'];
 		$model = Core::model('Thonto/Tochuc');
 		$row = $model->getThongtin(array('*'),'thonto_tochuc', null, array('id='.$id), null);
 		$row1 = $model->getThongtin(array('*'),'thonto_tochuc', null, array('trangthai_id = 1'), null);
 		$selected_px = (int)$row[0]->donvi_id;
 		$selected_chibo = (int)$row[0]->chibo_id;
 		$selected_loaihinhtochuc = (int)$row[0]->kieu;
 		$selected_hosochinh = (int)$row[0]->hosochinh_id;
 		$px_daco='0';
 		for ($i=0; $i<count($row1); $i++){
 			if ($row1[$i]->donvi_id>0 && $row1[$i]->donvi_id!=$selected_px)
 			$px_daco.=','.$row1[$i]->donvi_id;
 		}
 		$cboPhuongxa = $model->getCbo('ins_dept', 'id, name','id NOT IN( '.$px_daco.') and ins_cap IN (12,13)','name asc', '', '-- Chọn phường/xã quản lý --','id','name',$selected_px, 'donvi_id', '');
 		$cboHosochinh_id =$model->getCbo('hosochinh_quatrinhhientai','hosochinh_id, hoten','hoso_trangthai ="00" and congtac_donvi_id='.$selected_px,'hoten asc', '','-- Chọn cán bộ quản lý --','hosochinh_id','hoten', $selected_hosochinh,'hosochinh_id','');
 		$cboChibo = $model->getCbo('thonto_chibo','id, ten','donvi_id='.$selected_px,'ten asc', '','-- Chọn chi bộ --','id','ten', $selected_chibo,'chibo_id','');
 		$dboloaihinhtochuc = $model->getCbo('thonto_loaihinhtochuc','id, ten','trangthai=1','id asc', null,null,'id','ten', $selected_loaihinhtochuc,'type_content','');
 		
 		$this->assignRef('cboHosochinh_id', $cboHosochinh_id);
 		$this->assignRef('dboloaihinhtochuc', $dboloaihinhtochuc);
 		$this->assignRef('cboChibo', $cboChibo);
		$this->assignRef('cboPhuongxa', $cboPhuongxa);
 		$this->assignRef('row', $row[0]);
	 }
}
?>