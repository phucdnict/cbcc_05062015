<?php
class TochucViewGoiluong extends JViewLegacy
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
    	$db = JFactory::getDbo();
    	// lay ngach
    	$query = $db->getQuery(true);
    	//select id,name from function_code where status=1
    	$query->select(array('id','name'))->from('function_code')->where('status=1');
    	$db->setQuery($query);
    	$rows = $db->loadAssocList();
    	$ngachs = array();
    	for ($i = 0; $i < count($rows); $i++) {
    		$ngachs[$rows[$i]['id']] = $rows[$i];
    	}
    	 
    	//lay cb-bac-heso
    	$query = 'select a.mangach,a.name,a.idnganh,(SELECT ngach FROM cb_goiluong_ngach WHERE ngach = a.mangach AND id_goi = '.(int)$node_id.') AS checked from cb_bac_heso a';
    	//select id,name from function_code where status=1    	
    	$db->setQuery($query);
    	$rows = $db->loadAssocList();
    	$bacs = array();
    	for ($i = 0; $i < count($rows); $i++) {
    		$bacs[$rows[$i]['idnganh']][] = $rows[$i];    		
    	}
    	
     	
    	if ((int)$node_id > 0 ) {
    		$model = JModelLegacy::getInstance('Goiluong','TochucModel');
    		$row = $model->read($node_id);    	
    	}else{
    		$row = new stdClass();
    		$row->status = 1;
    		$row->parent_id = JRequest::getInt('parent_id',0);
    	}

    	
    	//var_dump($bacs);  	
    	$this->assignRef('row', $row);
    	$this->assignRef('ngachs', $ngachs);
    	$this->assignRef('bacs', $bacs);
    }
}
