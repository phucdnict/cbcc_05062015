<?php
/**
 * Author: Phucnh
 * Date created: Apr 04, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewChibo extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'detail':
					$this->setLayout('detail');
					break;
	  		case 'danhsachchibo':
	  			$this->danhsachchibo();
	  			break;
	  		case 'frmchibo':
					$this->setLayout('frmchibo');
					$this->frmchibo();
					break;
	  	}
	  	parent::display($tpl);
	 }
	 public function frmchibo(){
	 	$px_id = $_GET['px_id'];
	 	$chibo_id = (int)$_GET['chibo_id'];
	 	$model = Core::model('Thonto/Chibo');
	 	$row = $model->getThongtin('*', 'thonto_chibo', null, 'id='.$chibo_id, 'id asc');
	 	if ((int)$px_id >0)
	 		$this->assignRef('px_id', $px_id);
	 	else 
	 		$this->assignRef('px_id', $row[0]->donvi_id);
	 	$this->assignRef('row', $row[0]);
	 } 
	 public function danhsachchibo(){
	 	$id = $_GET['px_id'];
	 	$model = Core::model('Thonto/Chibo');
	 	$row = $model->getThongtin('*', 'thonto_chibo', null, 'donvi_id='.$id, 'id asc');
	 	Core::PrintJson($row);
	 }
	 
}
?>