<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewKhenthuongkyluat extends JViewLegacy{
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch ($task){
			case 'add_khenthuong':
			case 'edit_khenthuong':
				$this->_getEditKhenthuong();
				$this->setLayout('edit_khenthuong');
				break;
			case 'quatrinhkhenthuong':
				$this->_getQuatrinhkhenthuong();
				$this->setLayout('quatrinhkhenthuong');
				break;
			case 'add_kyluat':
			case 'edit_kyluat':
				$this->_getEditKyluat();
				$this->setLayout('edit_kyluat');
				break;
			case 'quatrinhkyluat':
				$this->_getQuatrinhkyluat();
				$this->setLayout('quatrinhkyluat');
				break;
			default :
				break;
		}
		parent::display($tpl);
    }
    private function _getQuatrinhkhenthuong(){
    	$idHoso = JRequest::getInt('idHoso',null);
    	$model = Core::model('Thonto/Khenthuongkyluat');
    	$items = $model->Quatrinhkhenthuong($idHoso);
    	
    	$this->assignRef('items', $items);
    }
    private function _getEditKhenthuong(){
    	$id_quatrinh = JRequest::getInt('id_quatrinh',null);
    	$model = Core::model('Thonto/Khenthuongkyluat');
    	if($id_quatrinh == null){
    		$item = array();
    	}else{
    		$item = $model->getInfoKhenthuong($id_quatrinh);
    	}
    	
    	$this->assignRef('item', $item);
    }
    private function _getQuatrinhkyluat(){
    	$idHoso = JRequest::getInt('idHoso', null);
    	$model = Core::model('Thonto/Khenthuongkyluat');
    	$items = $model->Quatrinhkyluat($idHoso);

    	$this->assignRef('items', $items);
    }
    private function _getEditKyluat(){
    	$id_quatrinh = JRequest::getInt('id_quatrinh',null);
    	$model = Core::model('Thonto/Khenthuongkyluat');
    	if($id_quatrinh == null){
    		$item = array();
    	}else{
    		$item = $model->getInfoKyluat($id_quatrinh);
    	}
    	
    	$this->assignRef('item', $item);
    }
}