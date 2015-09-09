<?php
require_once JPATH_LIBRARIES.'/cbcc/formvalidator.php';
class TochucValidate{
	public function formTochuc(){
		$validator = new FormValidator();
		$valid = array();
		$valid['NAME'] = array('req'=>"Please fill in Name");
		$valid['LOAIHINHBIENCHE'] = array('req'=>"Please fill in Name");
		
		foreach ($valid as $input => $aRow) {
			foreach ($aRow as $key=>$value) {
				$validator->addValidation($input,$key,$value);
			}			
		}
		return $validator;
	}
}