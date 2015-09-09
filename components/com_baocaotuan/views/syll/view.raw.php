<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class BaocaotuanViewSyll extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'word_syll_vc2c':
	  			$this->_vc2c();
	  			break;
	  	}
	  	parent::display($tpl);
	 }
	function _vc2c(){
		$idhoso = JRequest::getVar('idHoso');
		$model = JModelLegacy::getInstance('Syll','BaocaotuanModel');
		$data = $model->exportWord_2c($idhoso);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
		header ("Content-Disposition: attachment; Filename=VC-2C" . date ( 'dmy' ) . ".doc" );
		$this->assignRef('data', $data);
 		$this->setLayout('word_vc2c');	
	}
}
?>