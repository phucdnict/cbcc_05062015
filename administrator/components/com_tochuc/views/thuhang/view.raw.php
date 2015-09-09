<?php
class TochucViewThuhang extends JViewLegacy
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
    	$node_id = JRequest::getInt('id');
    	//var_dump($node_id);exit;
    	if ((int)$node_id > 0 ) {
    		$model = JModelLegacy::getInstance('Thuhang','TochucModel');
    		$row = $model->read($node_id);
    	}else{
    		$row = new stdClass();
    		$row->status = 1;
    		$row->parent_id = JRequest::getInt('parent_id',0);
    	}    	
    	$this->assignRef('row', $row);
    }
}
