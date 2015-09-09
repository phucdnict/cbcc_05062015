<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewCongtac extends JViewLegacy{
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch ($task){
			case 'add_congtac':
			case 'edit_congtac':
				$this->_getEditCongtac();
				$this->setLayout('edit_congtac');
				break;
			case 'quatrinhcongtac':
				$this->_getQuatrinhcongtac();
				$this->setLayout('quatrinhcongtac');
				break;
			default :
				break;
		}
		parent::display($tpl);
    }
    private function _getQuatrinhcongtac(){
    	$db = JFactory::getDbo();
    	$idHoso = JRequest::getInt('idHoso', null);
    	$model = Core::model('Thonto/Congtac');
    	$items = $model->getQuatrinhCongtac($idHoso);
    	
    	$this->assignRef('items', $items);
    }
    private function _getEditCongtac(){
    	$id_quatrinh = JRequest::getInt('id_quatrinh',null);
    	$model = Core::model('Thonto/Congtac');
    	if($id_quatrinh == null){
    		$item = array();
    	}else{
    		$item = $model->getInfoCongtac($id_quatrinh);
    	}
    	
    	$this->assignRef('item', $item);
    }
}