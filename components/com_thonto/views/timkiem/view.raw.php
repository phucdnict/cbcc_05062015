<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewTimkiem extends JViewLegacy {
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch($task){
			case 'ketqua':
				$this->_getKetqua();
				$this->setLayout('ketqua');
		   		break;
		}
		parent::display($tpl);
 	}
 	private function _getKetqua(){
 		$formData = JRequest::get('');
    	$model_hoso = Core::model('Thonto/Timkiem');
    	$items = $model_hoso->getDataTimkiem($formData);
    	
    	$this->assignRef('items', $items);
 	}
}
?>