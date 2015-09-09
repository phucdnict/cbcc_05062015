<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
* Số liệu biên chế cho trư
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class TochucViewSolieubienche extends JViewLegacy {
    function display($tpl = null) {
        $task = JRequest::getVar('task');
            switch($task){
            	case 'default':
            		$this->setLayout('default');
            		$this->_khoitao();
                    break;
                default:		                
                	$this->setLayout('hoso_404');
                	break;
  }
  parent::display($tpl);
 }
 function _khoitao(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/bootstrap.tab.ajax.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/caydonvi.js' );
 	$model = Core::model('Thongke/Thongke');
 	$idUser = JFactory::getUser()->id;
 	$idRoot = Core::getManageUnit($idUser, 'com_tochuc', 'treeview', 'treetochuc');
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