<?php
/**
 * Author: Phucnh
 * Date created: Apr 04, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewTinhhinhquanly extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'detail':
					$this->setLayout('detail');
					break;
	  		case 'frmtinhhinhquanly':
					$this->setLayout('frmtinhhinhquanly');
					$this->frmtinhhinhquanly();
					break;
	  	}
	  	parent::display($tpl);
	 }
	 public function frmtinhhinhquanly(){
	 	$thonto_id = (int)$_GET['thonto_id'];
	 	$dot = (int)$_GET['dot'];
	 	$model = Core::model('Thonto/Chibo');
	 	$row = $model->getThongtin('*', 'thonto_tinhhinhquanly', null, 'thonto_id='.$thonto_id.' and dotbaocao_id='.$dot, 'id asc');
	 	$noidunghop = $model->getThongtin('*', 'thonto_thongtinhopgiaoban', null, 'tinhhinhquanly_id='.(int)$row[0]->id, 'id asc');
 		$this->assignRef('noidunghop', $noidunghop);
	 	$this->assignRef('row', $row[0]);
	 } 
}
?>