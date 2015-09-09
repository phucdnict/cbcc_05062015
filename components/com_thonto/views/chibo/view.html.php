<?php
/**
 * Author: Phucnh
 * Date created: Aug 13, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewChibo extends JViewLegacy {
    function display($tpl = null) {
        $task = JRequest::getVar('task');
            switch($task){
            	case 'default':
                    $this->setLayout('default');
                    $this->dungchung();
                    $this->defaults();
                    break;
                default:		                
                	$this->setLayout('hoso_404');
                	break;
  }
  parent::display($tpl);
 }
 function dungchung(){
 	$document = JFactory::getDocument();
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript( JURI::base(true).'/media/cbcc/js/caydonvi.js' );
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.bootstrap.js');
	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/datatables.default.config.js');
 }
 function defaults(){
 	$model = Core::model('Thonto/Chibo');
 	$idUser = JFactory::getUser()->id;
//  	$idRoot = Core::getManageUnit($idUser, 'com_thonto', 'treeview', 'treeThonto');
	$idRoot = '154166';
 	if($idRoot == null){
 		$this->setLayout('hoso_404');
 	}else{
 		$root['root_id'] = $idRoot;
 		$tmp= $model->getThongtin(array('name, type'),'ins_dept',null,array('id='.$root['root_id']),null);
 		$root['root_name'] = $tmp[0]->name;
 		$root['root_showlist'] = $tmp[0]->type;
 	}
 	$this->assignRef('root_info', $root);
 }
}
?>