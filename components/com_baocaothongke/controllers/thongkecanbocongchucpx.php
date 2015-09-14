<?php
class BaocaothongkeControllerThongkecanbocongchucpx extends JControllerLegacy{
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		parent::display();
	}
	public function getData_thongkecanbocongchucpx(){
		$hosochinh_id = $_POST['hosochinh_id'];
		$model = Core::model('Baocaothongke/Thongkecanbocongchucpx');
		$array_canbo =  $model->getThongtincanhan($hosochinh_id);
		$array_canbo->ngaybatdau_bhxh = $model->getNgaybatdauBHXH($hosochinh_id);
		$ary_vanhoa = $model->trinhdovanhoa($hosochinh_id);
		$arr_chuyenmon = $model->trinhdochuyenmon($hosochinh_id);
		$arr_nghiepvu = $model->trinhdonghiepvu($hosochinh_id);
		$a = (object)array_merge((array)$arr_nghiepvu, (array)$array_canbo, (array)$arr_chuyenmon, (array)$ary_vanhoa);
		Core::PrintJson($a);
		die;
	}
}

