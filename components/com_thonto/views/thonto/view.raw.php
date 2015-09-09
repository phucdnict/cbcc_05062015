<?php
defined('_JEXEC') or die('Restricted access');
class ThontosViewThonto extends JViewLegacy{
	function display($tpl = null){
		$task = JRequest::getVar('task','default');
		switch ($task){
			case 'viewdanhsach':
				$this->setLayout('danhsachtrichngang');
				break;
			case 'hoso_add':
				$this->setLayout('hoso_add');
				break;
			case 'hoso_edit':
				$this->setLayout('hoso_edit');
				$this->_getHosoEdit();
				break;
			default :
				
				break;
		}
		parent::display($tpl);
	}
	private function _getHosoEdit(){
		$model = Core::model('Thonto/Hoso');
		$idHoso = JRequest::getInt('idHoso',null);
		if($idHoso == null){
			$item = array();
		}else{
			$item = $model->getInfoOfHoso($idHoso);
		}
		$this->assignRef('item', $item);
	}
}