<?php
class ThontosControllerTinhhinhhoatdong extends ThontosController {
	function __construct($config = array()) {
		parent::__construct ( $config );
	}
	function luutinhhinhhoatdong(){
		$form_tinhhinhhoatdong = $_POST;
		$values = array();
		parse_str($form_tinhhinhhoatdong['form_tinhhinhhoatdong'], $values);
		$model = Core::model('Thonto/Tinhhinhhoatdong');
		$insert_id = $model->luutinhhinhhoatdong($values);
		if (isset($values['id']) && (int)$values['id']>0)
			$model->xoaxulykiennghi($values['id']);
		if (isset($values['kiennghi_id'])){
			for($i = 0; $i<count($values['kiennghi_id']); $i++){
					$model->luuxulykiennghi($insert_id, $values['kiennghi_id'][$i],$values['soluongkiennghi'][$i],$values['dagiaiquyet_thonto'][$i],$values['dagiaiquyet_phuongxa'][$i],$values['dagiaiquyet_quanhuyentrolen'][$i]);
			}
			Core::PrintJson(true);
		}else Core::PrintJson(true);
	}
}
?>