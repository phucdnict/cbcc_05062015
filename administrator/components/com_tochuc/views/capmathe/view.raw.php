<?php
class TochucViewCapmathe extends JViewLegacy
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
    	$db = JFactory::getDbo();
    	$node_id = JRequest::getInt('id');
    	$arrChucvu = array();
    	if ((int)$node_id > 0 ) {
    		$model = JModelLegacy::getInstance('Goichucvu','TochucModel');
    		//$row = $model->read($node_id);
    		$arrChucvu = $model->getChucvuByIdGoichucvu((int)$node_id);    		
    	}else{
    		$row = new stdClass();
    		$row->status = 1;
    		//$row->id = 0;
    		$row->parent_id = JRequest::getInt('parent_id',0);
    	}
    	$this->assignRef('node_id', $node_id);
    	$this->assignRef('arrChucvu', $arrChucvu);

    	
    }
    
    private function _initDefaultPage(){
     	$document = JFactory::getDocument();
//     	//$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/js/jquery/select2/select2.css" rel="stylesheet" />');
     	$document->addCustomTag('<link href="'.JURI::root(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
//     	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.dataTables.min.js');
//     	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.dataTables.bootstrap.js');
     	$document->addScript(JURI::root(true).'/media/jui/js/jquery.min.js');
     	$document->addScript(JURI::root(true).'/media/cbcc/js/jstree/jquery.jstree.js');     	
//     	//$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/select2/select2.min.js');
//     	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
    }   
}
