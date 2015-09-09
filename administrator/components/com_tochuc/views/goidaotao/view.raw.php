<?php
class TochucViewGoidaotao extends JViewLegacy
{
    /**
     * @since  1.5
     */
    public function display($tpl = null)
    {    	
    	$task = JFactory::getApplication()->input->get('task');
    	$task = ($task == null)?'default':strtoupper($task);        
        $this->setLayout(strtolower($task));        
        switch($task){
        	case 'EDIT':        		       
        		$this->_initEditPage();
        		break;
            default:
                $this->_initDefaultPage();
                break;
        }
        parent::display($tpl);
    }
    
    private function _initEditPage(){
    	$id = JRequest::getInt('id');
    	$hinhthuc = null;
    	if ((int)$id > 0 ) {
    		$model =  Core::model('Danhmuc/CbGoidaotaoboiduong');
    		$row = $model->read($id);
    		$loaitrinhdoSelect = $model->getLoaiTrinhDoById($id);
    		//var_dump($loaitrinhdoSelect);
    	}else{
    		$row = array();
    		$row['status'] = 1;    	
    		$loaitrinhdoSelect = null;
    	}
    	$modelTypeScaCode =  Core::model('Danhmuc/TypeScaCode');
    	$loaitrinhdo = $modelTypeScaCode->findAll(array('is_nghiepvu'=>1));
//     	var_dump($row);
    	//var_dump($loaitrinhdoSelect);
    	$this->assignRef('loaitrinhdo', $loaitrinhdo);
    	$this->assignRef('loaitrinhdoSelect', $loaitrinhdoSelect);
    	$this->assignRef('row', $row);
    }
    
    private function _initDefaultPage(){
     	//$document = JFactory::getDocument();
     	//$document->addCustomTag('<link href="'.JURI::root(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
     	//$document->addScript(JURI::root(true).'/media/jui/js/jquery.min.js');
     	//$document->addScript(JURI::root(true).'/media/cbcc/js/jstree/jquery.jstree.js');     	
    }   
}
