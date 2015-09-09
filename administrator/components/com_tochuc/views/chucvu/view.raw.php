<?php
class TochucViewChucvu extends JViewLegacy
{
    /**
     * @since  1.5
     */
    public function display($tpl = null)
    {    	
    	$task = JFactory::getApplication()->input->get('task');
    	$task = ($task == null)?'default':strtoupper($task);        
        $this->setLayout(strtolower($task));        
        //var_dump($task);
        switch($task){
        	case 'EDIT':        		       
        		$this->_initEditPage();
        		break;
			case 'EDITPOS':
        		$this->_initEditPosPage();
        		break;
        }
        parent::display($tpl);
    }
    
    private function _initEditPage(){
    	$node_id = JRequest::getInt('id');
    	$items = array();
    	if ((int)$node_id > 0 ) {
    		$model = JModelLegacy::getInstance('Chucvu','TochucModel');
    		$row = $model->read($node_id);
    		// lay danh sach chuc vu
    		if ($row) {
    			$db = JFactory::getDbo();
    			$query = $db->getQuery(true);
    			$query->select('*')->from('cb_captochuc_chucvu')->where('idcap = '.(int)$row->id);
    			$db->setQuery($query);
    			$items = $db->loadObjectList();
    		}
    	
    	}else{
    		$row = new stdClass();
    		$row->status = 1;
    		$row->parentid = JRequest::getInt('parent_id',0);
    	}
    	//var_dump($row);
    	$this->assignRef('row', $row);
    	$this->assignRef('items', $items);    	
    }
    private function _initEditPosPage(){    	
    	$id = JRequest::getInt('id');
    	//var_dump($node_id);exit;
    
    	if ((int)$id > 0 ) {
    		$model = JModelLegacy::getInstance('Chucvu','TochucModel');
    		$item = $model->readPos($id);
    	}else{
    		$item = new stdClass();
    		$item->idcap = JRequest::getInt('idcap');
    	}
    	//var_dump($item);    	
    	$this->assignRef('item', $item);
    }
}
