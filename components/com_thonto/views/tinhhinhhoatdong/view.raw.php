<?php
/**
 * Author: Phucnh
 * Date created: Apr 04, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewTinhhinhhoatdong extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'detail':
					$this->setLayout('detail');
					break;
	  		case 'kiennghi':
					$this->setLayout('kiennghi');
					break;
	  		case 'frmtinhhinhhoatdong':
					$this->setLayout('frmtinhhinhhoatdong');
					$this->frmtinhhinhhoatdong();
					break;
	  	}
	  	parent::display($tpl);
	 }
	 public function frmtinhhinhhoatdong(){
	 	$thonto_id = (int)$_GET['thonto_id'];
	 	$dot = (int)$_GET['dot'];
	 	$model = Core::model('Thonto/Chibo');
	 	$row = $model->getThongtin('*', 'thonto_tinhhinhhoatdong', null, 'thonto_id='.$thonto_id.' and dotbaocao_id='.$dot, 'id asc');
	 	$kiennghi = $model->getThongtin('*', 'thonto_xulykiennghi', null, 'tinhhinhhoatdong_id='.(int)$row[0]->id, 'id asc');
 		$this->assignRef('kiennghi', $kiennghi);
	 	$this->assignRef('row', $row[0]);
	 } 
}
?>