<?php
class KekhaitaisanControllerKekhaitaisan extends JControllerLegacy
{
	function __construct($config = array()) {
		parent::__construct ( $config );
	}
  function luunhanthan(){
  		$values = array();
  		parse_str($_POST['form_nhanthan'], $values);
  		$kekhai_id 		= 	$_POST['kekhai_id']; 
  		$idHoso			=	$_POST['idHoso']; 
  		$model = Core::model('Kekhaitaisan/Kekhaitaisan');
  		Core::PrintJson($model->saveNhanthan($idHoso,$kekhai_id,$values));
  		die;
  }
  function luutaisan(){
  	$values = array();
  	parse_str($_POST['form_taisan'], $values);
  	$kekhai_id 		= 	$_POST['kekhai_id'];
  	$model = Core::model('Kekhaitaisan/Kekhaitaisan');
  	Core::PrintJson($model->saveTaisan($kekhai_id,$values));
  	die;
  }
}
?>
