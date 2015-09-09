<?php
class ThontosControllerTinhhinhquanly extends ThontosController {
	function __construct($config = array()) {
		parent::__construct ( $config );
	}
	function luutinhhinhquanly(){
		$form_tinhhinhquanly = $_POST;
		$values = array();
		parse_str($form_tinhhinhquanly['form_tinhhinhquanly'], $values);
		$model = Core::model('Thonto/Tinhhinhquanly');
		$insert_id = $model->luutinhhinhquanly($values);
		if (isset($values['id']) && (int)$values['id']>0)
			$model->xoanoidunghop($values['id']);
		if (count($values['noidunghop_id'])>0){
			for($i = 0; $i<count($values['noidunghop_id']); $i++){
					$model->luunoidunghop($insert_id, $values['noidunghop_id'][$i],$values['co_thuchien'][$i]);
			}
			Core::PrintJson(true);
		}else Core::PrintJson(true);
	}
}
?>