<?php
defined('_JEXEC') or die('Restricted access');
class ThontosControllerThonto extends ThontosController{
	function __construct($config = array()) {
		parent::__construct ( $config );
	}
	public function dataTrichngang(){
    	$id_donvi = JRequest::getInt('id_donvi',null);
    	$model = Core::model('Thonto/Danhsach');
    	$rows = $model->getDanhsachTrichngang($id_donvi);
    	Core::printJson($rows);
    }
    public function themmoiHoso(){
		$formData = JRequest::get('post');
    	$model_hoso = Core::model('Thonto/Hoso');
    	if(!$model_hoso->themmoiHoso($formData['hoso_add'])){
    		$result = '0';
    	}else{
    		$result = '1';
    	}
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
    public function capnhatHoso(){
    	$formData = JRequest::get('post');
    	$model_hoso = Core::model('Thonto/Hoso');
    	if(!$model_hoso->capnhatHoso($formData['hoso_edit'])){
    		$result = '0';
    	}else{
    		$result = '1';
    	}
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
	public function xoaHoso(){
		$formData = JRequest::get('post');
		$model_hoso = Core::model('Thonto/Hoso');
    	if(!$model_hoso->xoaHoso($formData)){
    		$result = '0';
    	}else{
    		$result = '1';
    	}
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
	}
    public function kiemtraCoChucvu(){
    	$donvi_id = JRequest::getInt('donvi_id',null);
    	$chucvu_id = JRequest::getInt('chucvu_id',null);
    	$model_hoso = Core::model('Thonto/Hoso');
    	$result = $model_hoso->hasChucvu($donvi_id, $chucvu_id);
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
    public function getChucvu(){
    	$loaihinhtochuc_id = JRequest::getInt('loaihinhtochuc_id',null);
    	$model_hoso = Core::model('Thonto/Hoso');
    	$result = $model_hoso->getChucvu($loaihinhtochuc_id);
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
    public function getThonto(){
    	$donvi_id = JRequest::getInt('donvi_id',null);
    	$model_hoso = Core::model('Thonto/Hoso');
    	$result = $model_hoso->getThonto($donvi_id);
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
    public function saveCongtac(){
    	$formData = JRequest::get('post');
    	$model_hoso = Core::model('Thonto/Hoso');
    	if(!$model_hoso->saveCongtac($formData['congtac'])){
    		$result = '0';
    	}else{
    		$result = '1';
    	}
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
    public function saveKhenthuong(){
    	$formData = JRequest::get('post');
    	$model_hoso = Core::model('Thonto/Hoso');
    	if(!$model_hoso->saveKhenthuong($formData['khenthuong'])){
    		$result = '0';
    	}else{
    		$result = '1';
    	}
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
    public function saveKyluat(){
    	$formData = JRequest::get('post');
    	$model_hoso = Core::model('Thonto/Hoso');
    	if(!$model_hoso->saveKyluat($formData['kyluat'])){
    		$result = '0';
    	}else{
    		$result = '1';
    	}
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
	public function removeQuatrinh(){
		$typeRemove = JRequest::getVar('typeRemove');
		$idHoso = JRequest::getInt('idHoso',null);
		$idsQuatrinh = JRequest::getVar('idsQuatrinh');
		$model_hoso = Core::model('Thonto/Hoso');
		$result = "Xóa dữ liệu thành công.";
		if(!$model_hoso->removeDataOfTable($typeRemove, $idsQuatrinh, $idHoso)){
			$result = 'Có lỗi xảy ra!!! Vui lòng liên hệ quản trị viên.';
		}
		Core::updateHosochinh($idHoso);
		header('Content-type: application/json');
		echo json_encode($result);
		die;
	}
}