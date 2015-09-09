<?php
class ThontosControllerThongke extends ThontosController {
	function __construct($config = array()) {
		parent::__construct ( $config );
	}
	public function getDulieuPhuluc1(){
		$model_hoso = Core::model('Thonto/Thongke');
		$result = $model_hoso->getDulieuPhuluc1();
		header('Content-type: application/json');
		echo json_encode($result);
		die;
	}
	function getDulieuPhuluc4(){
		$model = Core::model('Thonto/Thongke');
		header('Content-type: application/json');
		Core::PrintJson($model->bc_mau4());
		die;
	}
	function getDulieuPhuluc5(){
		$data = $_POST;
		$model = Core::model('Thonto/Thongke');
		$result = $model->getmau5($data);
		header('Content-type: application/json');
		echo json_encode($result);
		die;
	}
	public function getDulieuPhuluc6(){
		$model = Core::model('Thonto/Thongke');
		$result = $model->getmau6();
		header('Content-type: application/json');
		echo json_encode($result);
		die;
	}
}
?>