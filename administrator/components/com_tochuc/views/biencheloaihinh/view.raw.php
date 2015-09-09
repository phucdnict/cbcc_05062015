<?php
class TochucViewBiencheloaihinh extends JViewLegacy
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
        }
        parent::display($tpl);
    }
    
    private function _initEditPage(){
    	$id = JRequest::getInt('id');
    	if ((int)$id > 0 ) {
    		$model = JModelLegacy::getInstance('Biencheloaihinh','TochucModel');
    		$row = $model->read($id);
    	}else{
    		$row = new stdClass();
    		$row->status = 1;    		
    	}
    	//var_dump($row);
    	$this->assignRef('row', $row);
    }
    
    private function _initDefaultPage(){

    }   
}
