<?php
/**
 * Author: Phucnh
 * Date created: Aug 13, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewTochuc extends JViewLegacy {
    function display($tpl = null) {
        $task = JRequest::getVar('task');
            switch($task){
            	case 'default':
                    $this->setLayout('default');
                    $this->dungchung();
                    $this->defaults();
                    break;
            	case 'thanhlap':
                    $this->setLayout('thanhlap');
                    $this->dungchung();
                    $this->defaults();
                    $this->thanhlap();
                    break;
                default:		                
                	$this->setLayout('hoso_404');
                	break;
  }
  parent::display($tpl);
 }
 function dungchung(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/bootstrap.tab.ajax.js');
 }
 function defaults(){
 	$model = Core::model('Thonto/Tochuc');
 	$idUser = JFactory::getUser()->id;
//  	$idRoot = Core::getManageUnit($idUser, 'com_thonto', 'treeview', 'treeThonto');
	$idRoot = 1;
 	if($idRoot == null){
 		$this->setLayout('hoso_404');
 	}else{
 		$root['root_id'] = $idRoot;
 		$tmp= $model->getThongtin(array('ten, kieu'),'thonto_tochuc',null,array('id='.$root['root_id']),null);
 		$root['root_name'] = $tmp[0]->ten;
 		$root['root_showlist'] = $tmp[0]->kieu;
 	}
 	$this->assignRef('root_info', $root);
 }
	 function thanhlap(){
	 	$id = $_GET['id']==null ? '0':$_GET['id'];
 		$model = Core::model('Thonto/Tochuc');
 		$row = $model->getThongtin(array('*'),'thonto_tochuc', null, array('id='.$id), null);
 		$row1 = $model->getThongtin(array('*'),'thonto_tochuc', null, array('trangthai_id = 1'), null);
 		$selected_px = (int)$row[0]->donvi_id;
 		$selected_chibo = (int)$row[0]->chibo_id;
 		$selected_loaihinhtochuc = (int)$row[0]->kieu;
 		$px_daco='0';
 		for ($i=0; $i<count($row1); $i++){
 			if ($row1[$i]->donvi_id>0)
 			$px_daco.=','.$row1[$i]->donvi_id;
 		}
 		$cboPhuongxa = $model->getCbo('ins_dept', 'id, name','id NOT IN( '.$px_daco.') and ins_cap IN (12,13)','name asc', '', '-- Chọn phường/xã quản lý --','id','name',$selected_px, 'donvi_id', '');
 		
 		$cboChibo = $model->getCbo('thonto_chibo','id, ten','donvi_id='.$selected_px,'ten asc', '','-- Chọn chi bộ --','id','ten', $selected_chibo,'chibo_id','');
 		$dboloaihinhtochuc = $model->getCbo('thonto_loaihinhtochuc','id, ten','trangthai=1','id asc', null,null,'id','ten', $selected_loaihinhtochuc,'type_content','');
 		
 		$this->assignRef('dboloaihinhtochuc', $dboloaihinhtochuc);
 		$this->assignRef('cboChibo', $cboChibo);
		$this->assignRef('cboPhuongxa', $cboPhuongxa);
 		$this->assignRef('row', $row[0]);
 }
}
?>