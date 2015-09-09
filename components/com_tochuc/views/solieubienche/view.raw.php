<?php
/**
 * Author: Phucnh
 * Date created: May 26, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class TochucViewSolieubienche extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'frmsolieu':
	  			$this->setLayout('frmsolieu');
	  			$this->frmsolieu();
	  			break;
	  	}
	  	parent::display($tpl);
	 }
	 function frmsolieu(){
	 	$donvi_id = JRequest::getInt('donvi_id',null);
	 	$model = Core::model('Tochuc/Solieubienche');
	 	$bienche = $model->getThongtin('*', 'ins_soluongbchd', null, 'id_donvi = '.$donvi_id,null);
	 	$this->assignRef('row',$bienche[0]);
	 	$this->assignRef('donvi_id', $donvi_id);
	 }
}
?>