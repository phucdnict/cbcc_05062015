<?php
class TochucViewTochuc extends JViewLegacy
{
    /**
     * @since  1.5
     */
    public function display($tpl = null)
    {   
    	$task = JFactory::getApplication()->input->get('task');
    	$task = ($task == null)?'default':strtoupper($task);        
        $this->setLayout(strtolower($task));
        $this->assignRef('Itemid', JFactory::getApplication()->input->get('Itemid'));
        switch($task){
            case 'EDIT':            	
                $this->_initEditPage();
                break;
			case 'EDITPHONG':
				$this->_initEditPhongPage();
				break;                
			case 'THANHLAP':
            	$this->_initThanhLapPage();
                break;
			case 'SAPNHAP':
              	$this->_initSapnhapPage();
               	break;                
            case 'THANHLAPPHONG':
                $this->_initThanhLapPhongPage();
                break;
            case 'danhsach':
            	$this->_initDanhsachPage($task);
            	break;
            case 'GIAITHE':
            	$this->_initGiaithePage();
            	break;
            default:
                $this->_initDefaultPage($task);
                break;
        }                
        parent::display($tpl);
    }
    private function _initDefaultPage($task){
    	$document = JFactory::getDocument();
    	//$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/css/offcanvas.css" rel="stylesheet" />');
    	$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/css/jquery.fileupload.css" rel="stylesheet" />');
    	$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
    	//$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/css/chosen.min.css" rel="stylesheet" />');
    	//$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.dataTables.min.js');
    	//$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.dataTables.bootstrap.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');    	
    	//$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/select2/select2.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery.maskedinput.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/upload/jquery.iframe-transport.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/upload/jquery.fileupload.js');
    	//$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.offcanvas.min.js');
    	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/date-time/date.js');
		$document->addScript( JURI::base(true) . '/media/cbcc/js/caydonvi.js' );
    }
 
    private function _initDanhsachPage($task){
    	$mDanhsachtochuc = Core::model('Tochuc/Danhsachtochuc');
    	$this->nodeRoot = $mDanhsachtochuc->read(150000);
    	$this->_addCssAndScript($task,array('root_id'=>1));
    }
    private function _initEditPage(){
    	$document = JFactory::getDocument();
    	$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/css/jquery.fileupload.css" rel="stylesheet" />');
    	$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/fuelux/fuelux.tree.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery.maskedinput.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/upload/jquery.iframe-transport.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/upload/jquery.fileupload.js');
    	$deptRoot = TochucHelper::getRoot();
    	$deps = TochucHelper::collect('ins_dept', array('id AS value','name AS text'),array('type = 1','active = 1'),array('lft ASC'));
    	$option[] = array("value"=>'',"text"=>'');
    	$option[] = array("value"=>$deptRoot['id'],"text"=>$deptRoot['name']);
    	$deps = array_merge($option, $deps);
    	// 		$inArray = TochucHelper::collect('ins_dept', array('id','parent_id','name',"IF((type = 1),'item','folder') AS type"));
    	// 		$outArray = array();
    	//TochucHelper::makeDataForTree(&$inArray, &$outArray);
    	//unset($inArray);
    	$inArray = TochucHelper::collect('ins_cap', array('id','parent_id','name',"IF((rgt-lft) = 1,'item','folder') AS type"),array('status = 1'));
    	//var_dump($inArray);
    	$tree_data_ins_cap = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_cap,TochucHelper::getRootCapTochuc());
    	unset($inArray);
    	$inArray = TochucHelper::collect('ins_level', array('id','parent_id','name',"IF((rgt-lft) = 1,'item','folder') AS type"),array('status = 1'));
    	$tree_data_ins_level = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_level,1);
    	unset($inArray);
    	$inArray = TochucHelper::collect('pos_system', array('id','parent_id','name',"IF((rgt-lft) = 1,'item','folder') AS type"),array('status = 1'));
    	$tree_data_ins_goichucvu = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_goichucvu,TochucHelper::getRootGoichucvu());
    	unset($inArray);
    	$inArray = TochucHelper::collect('cb_goiluong', array('id','parent_id','name',"IF((rgt-lft) = 1,'item','folder') AS type"),array('status = 1'));
    	$tree_data_ins_goiluong = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_goiluong,TochucHelper::getRootGoiLuong());
    	unset($inArray);
    	$inArray = TochucHelper::collect('cb_type_linhvuc', array('id','parent_id','name',"IF((rgt-lft) = 1,'item','folder') AS type"));
    	$tree_data_ins_linhvuc = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_linhvuc,TochucHelper::getRootLinhvucTochuc());
    	unset($inArray);
    	$inArray = TochucHelper::collect('ins_dept_loaihinh', array('id','parent_id','name',"IF((rgt-lft) = 1,'item','folder') AS type"));
    	$tree_data_ins_loaihinh = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_loaihinh,TochucHelper::getRootLoaihinh());
    	unset($inArray);
    	$inArray = TochucHelper::collect('ins_dept', array('id','parent_id','name',"IF((type = 1),'item','folder') AS type"),array('type IN (1,2,3)'),'lft ASC');
    	$tree_data_ins_dept = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_dept, $deptRoot['id']);
    	unset($inArray);
    	// 		$inArray = TochucHelper::getAllVoboc();
    	// 		$tree_data_ins_parent = array();
    	// 		TochucHelper::makeDataForTree($inArray, &$tree_data_ins_parent,$deps['id']);
    	//unset($inArray);
    	$this->assignRef('Itemid', JFactory::getApplication()->input->get('Itemid'));
    	$this->assignRef('deps', $deps);
    	$this->assignRef('tree_data_ins_cap', json_encode($tree_data_ins_cap));
    	$this->assignRef('tree_data_ins_level', json_encode($tree_data_ins_level));
    	$this->assignRef('tree_data_ins_goichucvu', json_encode($tree_data_ins_goichucvu));
    	$this->assignRef('tree_data_ins_goiluong', json_encode($tree_data_ins_goiluong));
    	$this->assignRef('tree_data_ins_linhvuc', json_encode($tree_data_ins_linhvuc));
    	$this->assignRef('tree_data_ins_loaihinh', json_encode($tree_data_ins_loaihinh));
    	$this->assignRef('tree_data_ins_dept', json_encode($tree_data_ins_dept));
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');	
    	$model = Core::model('Tochuc/Tochuc');
		$dept_id = JRequest::getInt('id',0);
		$row = $model->read($dept_id);
		$vanban_created = $model->getVanbanById($row->vanban_created);
		$trangthai = $model->getVanbanById($row->vanban_active);
		$file_created = $model->getFilebyIdVanban($row->vanban_created);
		$file_trangthai = $model->getFilebyIdVanban($row->vanban_active);
		$this->assignRef('row', $row);
		$this->assignRef('vanban_created', $vanban_created);
		$this->assignRef('trangthai', $trangthai);
		$this->assignRef('file_created', $file_created);
		$this->assignRef('file_trangthai', $file_trangthai);
		
    	unset($tree_data_ins_loaihinh);
    	unset($tree_data_ins_cap);
    	unset($tree_data_ins_level);
    	unset($tree_data_ins_goichucvu);
    	unset($tree_data_ins_goiluong);
    	unset($tree_data_ins_linhvuc);
    	unset($tree_data_ins_parent);
    	unset($tree_data_ins_dept);
    	unset($row);
    	unset($vanban_created);
    	unset($file_created);
    	unset($trangthai);
    	unset($file_trangthai);
    
    }
    private function _initEditPhongPage(){
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$document = JFactory::getDocument();
    	$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
    	//$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/select2/select2.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery.maskedinput.min.js');
    	$dept_id = JRequest::getInt('id',0);
    	$row = $model->read($dept_id);
    	$this->assignRef('row', $row);
    	//$document->addScript('jquery.validate.min.js');
    	
    
    
    }
    private function _initThanhLapPage(){    	
		$document = JFactory::getDocument();
    	$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
    	$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/css/jquery.fileupload.css" rel="stylesheet" />');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/fuelux/fuelux.tree.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery.maskedinput.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/upload/jquery.iframe-transport.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/upload/jquery.fileupload.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/date-time/date.js');
    	$dept_id = JRequest::getInt('id',0);
    	$row = null;
    	if((int)$dept_id > 0 ){
//     		$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    		$model = Core::model('Tochuc/Tochuc');
    		$row = $model->read($dept_id);
    	}
    	if ((int)$row->id == 0 ) {
    		$row->type = 1;
    	}
    	$this->assignRef('id', $dept_id);
    	$this->assignRef('row', $row);
    }
    private function _initSapnhapPage(){
    	$document = JFactory::getDocument();
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
		//$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/select2/select2.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery.maskedinput.min.js');
    }
    private function _initThanhLapPhongPage(){
		$document = JFactory::getDocument();
		$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
		//$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/select2/select2.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery.maskedinput.min.js');    
    } 
    private function _initGiaithePage(){
    	$document =  JFactory::getDocument();
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery.maskedinput.min.js');  
    	$id_donvi = JRequest::getInt('id',null);
    	$model_thongtinchung = Core::model('Hoso/Thongtinchung');
    	$items = $model_thongtinchung->getDanhsachByDonvi($id_donvi, '00');
    	
    	$this->assignRef('items', $items);
    } 
 
}
