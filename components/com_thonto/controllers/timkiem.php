<?php
defined('_JEXEC') or die('Restricted access');
class ThontosControllerTimkiem extends ThontosController{
	function __construct($config = array()) {
		parent::__construct ( $config );
	}
    public function getThonto(){
		$phuongxa_ids = JRequest::getVar('phuongxa_ids');
    	$model_hoso = Core::model('Thonto/Timkiem');
    	$result = $model_hoso->getThonto($phuongxa_ids);
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
}