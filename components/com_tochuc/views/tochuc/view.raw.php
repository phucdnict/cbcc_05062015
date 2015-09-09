<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
class TochucViewTochuc extends JViewLegacy{
    public function display($tpl = null){
        $task = JFactory::getApplication()->input->get('task');
    	$task = ($task == null)?'default':strtoupper($task);
    	$this->assignRef('Itemid', JFactory::getApplication()->input->get('Itemid'));
        $this->setLayout(strtolower($task));        
        switch($task){
        	case 'READQUATRINH':
        		$this->_readQuaTrinh();
        		break;
            case 'LIST':            	
                $this->_getList();
                break;
			case 'DETAIL':
              	$this->_getDetail();
               	break;
			case 'QUATRINH':
				$this->_pageQuaTrinh();
               	break;
			case 'GIAOBIENCHE':
				$this->_pageGiaobienche();
               	break;
			case 'KHENTHUONGKYLUAT':
				$this->_pageKhenthuongkyluat();
				break;
			case 'EDITGIAOBIENCHE':
             	$this->_pageEditGiaobienche();
				break;
			case 'EDITKHENTHUONG':
				$this->_pageEditKhenthuong();
				break;
			case 'EDITKYLUAT':
				$this->_pageEditKyluat();
				break;
			case 'EDITTOCHUC':
				$this->_pageEditTochuc();
				break;	
			case 'EDITPHONG':
				$this->_pageEditPhong();
				break;
			case 'EDITVOCHUA':
				$this->_pageEditVochua();
				break;				
            default:
                $this->_initDefaultPage($task);
                break;
                     
        }
        parent::display($tpl);
    }
    private function _pageEditTochuc(){
    	$deptRoot = TochucHelper::getRoot();
    	//$deps = TochucHelper::collect('ins_dept', array('id AS value','name AS text'),array('type = 1','active = 1'),array('lft ASC'));
    	$option[] = array("value"=>'',"text"=>'');
    	$option[] = array("value"=>$deptRoot['id'],"text"=>$deptRoot['name']);
    	//$deps = array_merge($option, $deps);
    	// 		$inArray = TochucHelper::collect('ins_dept', array('id','parent_id','name',"IF((type = 1),'item','folder') AS type"));
    	// 		$outArray = array();
    	//TochucHelper::makeDataForTree(&$inArray, &$outArray);
    	//unset($inArray);
    	$inArray = TochucHelper::collect('ins_cap', array('id','parent_id','name',"IF((rgt-lft) = 1,'item','folder') AS type"),array('status = 1'));
    	//var_dump($inArray);
    	$tree_data_ins_cap = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_cap,TochucHelper::getRootCapTochuc());
    	unset($inArray);    	
    	$inArray = TochucHelper::collect('cb_goichucvu', array('id','parent_id','name',"IF((rgt-lft) = 1,'item','folder') AS type"),array('status = 1'));
    	//var_dump($inArray);exit;
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
    	$inArray = TochucHelper::collect('ins_dept', array('id','parent_id','name',"IF((type = 1),'item','folder') AS type"),array('type IN (1,2,3)'),'lft ASC');    	
    	$tree_data_ins_dept = array();    	
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_dept);
    	unset($inArray);
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$dept_id = JRequest::getInt('id',0);
    	$row = null;
    	$arr_ins_created =  TochucHelper::collect('ins_dept', array('id AS value','name AS text'),array('type IN (1,3)'),'lft ASC');
    	$arr_ins_created = array_merge(array(array('value'=>'','text'=>'')),$arr_ins_created);
    	if((int)$dept_id > 0){
    		$row = $model->read($dept_id);
    	}    	
    	if ($row->id == null) {
    		$vanban_created = array();
    		$trangthai = array();
    		$file_created = array();
    		$file_trangthai = array();    	
    		$row->active = 1;
    		$row->type = JRequest::getInt("type",0);
    		$linhvuc = array();
    	}else{
    		$vanban_created = $model->getVanbanById($row->vanban_created);
    		$trangthai = $model->getVanbanById($row->vanban_active);
    		$file_created = $model->getFilebyIdVanban($row->vanban_created);
    		$file_trangthai = $model->getFilebyIdVanban($row->vanban_active);
    		$linhvuc = $model->getLinhvucByIdDept($row->id);
    		$row->type = JRequest::getInt("type",0);
    	}
    	$caybaocao	=	$model->getCayBaocao();
    	$this->assignRef('caybaocao', $caybaocao);
    	//var_dump($linhvuc);
    	$this->assignRef('Itemid', JFactory::getApplication()->input->get('Itemid'));
    	//$this->assignRef('deps', $deps);
    	$this->assignRef('tree_data_ins_cap', json_encode($tree_data_ins_cap));
    	$this->assignRef('tree_data_ins_dept', json_encode($tree_data_ins_dept));
    	$this->assignRef('row', $row);
    	$this->assignRef('vanban_created', $vanban_created);
    	$this->assignRef('trangthai', $trangthai);
    	$this->assignRef('linhvuc', $linhvuc);
    	$this->assignRef('file_created', $file_created);
    	$this->assignRef('file_trangthai', $file_trangthai);
    	$this->assignRef('arr_ins_created', $arr_ins_created);
    	
    	
    	unset($tree_data_ins_cap);
    	
    	unset($tree_data_ins_goichucvu);
    	unset($tree_data_ins_goiluong);
    	unset($tree_data_ins_linhvuc);    	
    	unset($tree_data_ins_dept);
    	unset($row);
    	unset($vanban_created);
    	unset($file_created);
    	unset($trangthai);
    	unset($file_trangthai);
    }
    private function _pageEditPhong(){
    	$deptRoot = TochucHelper::getRoot();
    	$inArray = TochucHelper::collect('ins_dept', array('id','parent_id','name',"IF((type = 1),'item','folder') AS type"),array('type IN (1,2,3)'),'lft ASC');
    	$tree_data_ins_dept = array();
    	TochucHelper::makeDataForTree($inArray, $tree_data_ins_dept);
    	unset($inArray);
    	// 		$inArray = TochucHelper::getAllVoboc();
    	// 		$tree_data_ins_parent = array();
    	// 		TochucHelper::makeDataForTree($inArray, &$tree_data_ins_parent,$deps['id']);
    	//unset($inArray);
    	$this->assignRef('Itemid', JFactory::getApplication()->input->get('Itemid'));
    	///$this->assignRef('deps', $deps);

    	
    	$this->assignRef('tree_data_ins_dept', json_encode($tree_data_ins_dept));
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');		
    	$dept_id = JRequest::getInt('id',0);
    	$row = null;
    	$arr_ins_created =  TochucHelper::collect('ins_dept', array('id AS value','name AS text'),array('type IN (1,3)'),'lft ASC');
    	$arr_ins_created = array_merge(array(array('value'=>'','text'=>'')),$arr_ins_created);
    	if((int)$dept_id > 0){
    		$row = $model->read($dept_id);
    	}
    	if ($row->id == null) {
    		$vanban_created = array();
    		$trangthai = array();
    		$file_created = array();
    		$file_trangthai = array();    		
    		$row->active = 1;
    		//$row->active = 1;
    		$row->type = JRequest::getInt("type",0);
    		$linhvuc = array();
    	}else{
    		$vanban_created = $model->getVanbanById($row->vanban_created);
    		$trangthai = $model->getVanbanById($row->vanban_active);
    		$file_created = $model->getFilebyIdVanban($row->vanban_created);
    		$file_trangthai = $model->getFilebyIdVanban($row->vanban_active);
    		$linhvuc = $model->getLinhvucByIdDept($row->id);
    		$row->type = JRequest::getInt("type",0);
    	}
    	
    	$caybaocao	=	$model->getCayBaocao();
    	$this->assignRef('caybaocao', $caybaocao);
    	
    	$this->assignRef('row', $row);
    	$this->assignRef('vanban_created', $vanban_created);
    	$this->assignRef('trangthai', $trangthai);
    	$this->assignRef('file_created', $file_created);
    	$this->assignRef('file_trangthai', $file_trangthai);
    	$this->assignRef('linhvuc', $linhvuc);
    	$this->assignRef('arr_ins_created', $arr_ins_created);
     	unset($tree_data_ins_linhvuc);    	
    	unset($tree_data_ins_dept);
    	unset($row);
    	unset($vanban_created);
    	unset($file_created);
    	unset($trangthai);
    	unset($file_trangthai);
    }
    private function _pageEditVochua(){
    	$deptRoot = TochucHelper::getRoot();    
    	$this->assignRef('Itemid', JFactory::getApplication()->input->get('Itemid'));    	
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$dept_id = JRequest::getInt('id',0);
    	$row = null;
    	if((int)$dept_id > 0){
    		$row = $model->read($dept_id);
    		$row->type = JRequest::getInt("type",0);
    	}
    	if ($row->id == null) {
    		$row->active = 1;
    		$row->type = JRequest::getInt("type",0);
    	}
    	$caybaocao	=	$model->getCayBaocao();
    	$this->assignRef('caybaocao', $caybaocao);
    	
    	$vanban_created = array();
    	$trangthai = array();
    	$file_created = array();
    	$file_trangthai = array();
    	$this->assignRef('row', $row);
    	$this->assignRef('vanban_created', $vanban_created);
    	$this->assignRef('trangthai', $trangthai);
    	$this->assignRef('file_created', $file_created);
    	$this->assignRef('file_trangthai', $file_trangthai);
  
    }
    private function _readQuaTrinh(){
    	$quatrinh_id = JRequest::getInt('id',0);
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$mapperFile = Core::model('Core/Attachment');
    	$row = $model->getOneQuaTrinhById($quatrinh_id);
    	$dept = Core::read('ins_dept', array('id = '=>$row['dept_id']));
    
    	$row['vanban'] = TochucHelper::getVanBanById($row['vanban_id']);
    	$row['file'] = $mapperFile->getRowByObjectIdAndTypeId($row['vanban_id'],1);
    	$row['hieuluc_ngay'] = TochucHelper::strDateMySqltoVN($row['hieuluc_ngay']);
    	$row['dept_name'] = $dept['name'];
    	$this->_printJson($row);
    }
    private function _pageQuaTrinh(){
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$id = JRequest::getInt('id',0);    	
    	$rows = $model->getAllQuaTrinhById($id);
    	$item = $model->read($id);
    	$this->assignRef('id', $id);    	
    	$this->assignRef('rows', $rows);
    	//$this->assignRef('deps', $deps);
    	$this->assignRef('item', $item);
    }
    private function  _pageEditGiaobienche(){
    	//echo '_pageEditGiaobienche';
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$id = JRequest::getInt('id',0);    	
    	$item = $model->getQuatrinhBiencheById($id);
    	if ($item->id == NULL) {
    		$dept_id = JRequest::getInt('dept_id',0);    		
    		$dept = $model->read($dept_id);
    		$hinhthuc_bienche =  $model->getHinhThucBienche($dept->goibienche);
    		$file = null;
    	}else{
    		$hinhthuc_bienche =  $model->getHinhThucBienCheByQuatrinh($id);
    		$dept_id = $item->dept_id;
    		$mapperFile = Core::model('Core/Attachment');
    		$file = $mapperFile->getRowByObjectIdAndTypeId($item->vanban_id,1);
    	}
    	$this->assignRef('hinhthuc_bienche', $hinhthuc_bienche);
    	$this->assignRef('item', $item);
    	$this->assignRef('id', $id);
    	$this->assignRef('dept_id', $dept_id);
    	$this->assignRef('file', $file);
    }
    private function _pageGiaobienche(){
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$id = JRequest::getInt('id',0);
    	//$rows = $model->getAllQuaTrinhById($id);
    	//var_dump($row);
    	//$deps = TochucHelper::collect('ins_dept', array('id AS value','name AS text'),array('TYPE = 1 OR TYPE = 2','ACTIVE = 1'),array('lft ASC'));
    	//$option = array("value"=>'',"text"=>'');
    	//array_unshift($deps, $option);
    	//$name = TochucHelper::getNameById($id, 'ins_dept');
    	//var_dump($name);
    	$item = $model->read($id);    	
    	$quatrinh_bienche = $model->getQuatrinhBiencheByDeptId($item->id);
    	//$hinhthuc_bienche =  $model->getHinhThucBienche($item->GOIBIENCHE);
    	
    	$this->assignRef('id', $id);    	
    	//$this->assignRef('hinhthuc_bienche', $hinhthuc_bienche);
    	//$this->assignRef('rows', $rows);
    	$this->assignRef('quatrinh_bienche', $quatrinh_bienche);
    	$this->assignRef('item', $item);
    
    }
    // Phúc thêm 
    private function _pageKhenthuongkyluat(){
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$id = JRequest::getInt('id',0);
    	$item = $model->read($id);    	// select * from ins_dept where id=$id
    	$quatrinh_khenthuong = $model->getAllKhenthuongById($item->id);
    	$quatrinh_kyluat = $model->getAllKyluatById($item->id);
    	$this->assignRef('id', $id);    	
    	$this->assignRef('quatrinh_khenthuong', $quatrinh_khenthuong);
    	$this->assignRef('quatrinh_kyluat', $quatrinh_kyluat);
    	$this->assignRef('item', $item);
    }
    private function  _pageEditKhenthuong(){
    	$model = Core::model('Tochuc/Tochuc');
    	$id = JRequest::getInt('id',0); // id của quá trình khi chọn
    	$item = $model->getEditKhenthuongById($id);
    	if ($id != NULL )
    		$dept_id = $item[0]->iddonvi_kt;
    	else{
    		$dept_id = JRequest::getInt('dept_id',0);
    	}
    	$this->assignRef('item', $item);
    	$this->assignRef('tbl', $tbl);
    	$this->assignRef('ht', $ht);
    	$this->assignRef('id', $id);
    	$this->assignRef('dept_id', $dept_id);
    }
    private function  _pageEditKyluat(){
    	$model = Core::model('Tochuc/Tochuc');
    	$id = JRequest::getInt('id',0); // id của quá trình khi chọn
    	$item = $model->getEditKyluatById($id);
    	if ($id != NULL )
    		$dept_id = $item[0]->iddonvi_kl;
    	else{
    		$dept_id = JRequest::getInt('dept_id',0);
    	}
    	$this->assignRef('item', $item);
    	$this->assignRef('tbl', $tbl);
    	$this->assignRef('ht', $ht);
    	$this->assignRef('id', $id);
    	$this->assignRef('dept_id', $dept_id);
    }
//   end Phúc thêm
    private function _getDetail(){
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$id = JRequest::getInt('id',0);
    	$row = $model->read($id);
    	$quatrinh = $model->getAllQuaTrinhById($row->id);
    	$khenthuongkyluat = $model->getAllKhenthuongkyluatById($row->id);
    	$quatrinh_bienche = $model->getQuatrinhBiencheByDeptId($row->id);
    	$vanban_created = array();
    	$vanban_active = array();
    	if ((int)$row->vanban_created > 0 ) {
    		$vanban_created = $model->getVanbanById($row->vanban_created);
    		if ($vanban_created != null) {
    			if (Core::loadResult('core_attachment', 'COUNT(*)', array('object_id='=>$vanban_created['id'],'type_id='=>1))> 0 ) {
    				$vanban_created['mahieu'] = '<a href="'.JUri::root(true).'/uploader/index.php?download=1&type_id=1&object_id='.$vanban_created['id'].'" target="_blank">'.$vanban_created['mahieu'].'</a>';
    			}	
    		}
    		
    	}
    	if ((int)$row->vanban_active > 0 ) {
    		$vanban_active = $model->getVanbanById($row->vanban_active);
    		if ($vanban_active != null) {
    			if (Core::loadResult('core_attachment', 'COUNT(*)', array('object_id='=>$vanban_active['id'],'type_id='=>1))> 0 ) {
    				$vanban_created['mahieu'] = '<a href="'.JUri::root(true).'/uploader/index.php?download=1&type_id=1&object_id='.$vanban_active['id'].'" target="_blank">'.$vanban_active['mahieu'].'</a>';
    			}
    		}
    	}
    	//var_dump($row);
    	$this->assignRef('sumBienchegiao', $model->sumBienchegiao($id));
    	$this->assignRef('sumBienchehienco', $model->sumBienchehienco($id));
    	$this->assignRef('id', $id);    	
    	$this->assignRef('row', $row);
    	$this->assignRef('quatrinh', $quatrinh);
    	$this->assignRef('khenthuongkyluat', $khenthuongkyluat);
    	$this->assignRef('quatrinh_bienche', $quatrinh_bienche);
    	$this->assignRef('vanban_created', $vanban_created);
    	$this->assignRef('vanban_active', $vanban_active);

    }
    private function _getList(){    
//     	$model = JModelLegacy::getInstance('Tochuc','TochucModel');
    	$model = Core::model('Tochuc/Tochuc');
    	$params = JRequest::get('get');
    	$output = $model->listAll($params);
    	//$rows['aaData'] = $rows['aaData'];

    	$this->_printJson($output);
    }
    private function _printJson($rows){
    	$callback = JFactory::getApplication()->input->get('callback');
    	$rows=json_encode($rows);
    	header("HTTP/1.0 200 OK");
    	header('Content-type: application/json; charset=utf-8');
    	header("Cache-Control: no-cache, must-revalidate");
    	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    	header("Pragma: no-cache");
    	if (!empty($callback)){
    		echo $callback . '(',$rows, ');';
    	}else{
    		echo $rows;
    	}
    	die;
    }
   
}
