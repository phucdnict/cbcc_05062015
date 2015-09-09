<?php
class TochucViewGoichucvu extends JViewLegacy
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
        	case 'COEF':
        		$this->getCoef();
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
    		$row = $model->read($node_id);
    		$arrChucvu = $model->getChucvuByIdGoichucvu($row->id);    		
    	}else{
    		$row = new stdClass();
    		$row->status = 1;
    		//$row->id = 0;
    		$row->parent_id = JRequest::getInt('parent_id',0);
    	}
    	//var_dump($row);
    	// lay du lieu tree
//     	$query = "SELECT a.id,a.parent_id,a.name as data,IF(b.goichucvu_id IS NOT NULL,'jstree-checked','jstree-unchecked') AS class,IF(a.chucvu = 1,'file','folder') AS type  FROM pos_system a LEFT JOIN cb_goichucvu_chucvu b ON b.pos_system_id = a.id AND b.goichucvu_id = ".$db->quote($node_id)." WHERE a.status = 1";
    	$query = "SELECT a.id,a.parent_id,a.name as data,IF(a.chucvu = 1,'file','folder') AS type  FROM pos_system a  WHERE a.status = 1";
    	$db->setQuery($query);
    	$inArray = $db->loadAssocList();
    	//var_dump($inArray);
    	$tree_data_pos_system = array();
    	AdminTochucHelper::makeParentChildRelationsForTree($inArray, &$tree_data_pos_system, 5);
    	unset($inArray);
    	$query = "SELECT a.id,a.parent_id,a.name,IF(b.ins_level_id IS NOT NULL,'jstree-checked','jstree-unchecked') AS class,IF((a.rgt-a.lft) = 1,'file','folder') AS type FROM ins_level a LEFT JOIN cb_goichucvu b ON b.ins_level_id = a.id AND b.id =  ".$db->quote($node_id)." WHERE a.status = 1";
    	$db->setQuery($query);
    	$inArray = $db->loadAssocList();
    	//var_dump($inArray);
    	$tree_data_ins_level = array();
    	AdminTochucHelper::makeParentChildRelationsForTree($inArray, &$tree_data_ins_level, 0);
    	unset($inArray);
    	
    	$this->assignRef('row', $row);
    	$this->assignRef('arrChucvu', $arrChucvu);
    	$this->assignRef('tree_data_pos_system', $tree_data_pos_system);
    	$this->assignRef('tree_data_ins_level', $tree_data_ins_level);
    	
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
    public function getCoef(){
    	$id = JRequest::getVar('node_id','1');
    	$model = JModelLegacy::getInstance('Goichucvu','TochucModel');//&JModelLegacy::getInstance('DMCongtacModelHinhthucbienche');
    	$result = $model->getHesoById($id);
    	header('Content-type: application/json');
    	echo json_encode($result);
    	die;
    }
}
