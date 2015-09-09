<?php
defined('_JEXEC') or die('Restricted access');
class ThontoViewChucvu extends JViewLegacy{
function display($tpl = null) {
//	$user = JFactory::getUser();
//	echo $user->id;
		$task = JRequest::getVar('task');
		switch($task){
			case 'add':
			case 'edit':
				$this->getEditItem();
				$this->setLayout('add');
				break;
			default :
				$this->getDanhsach();
				$this->setLayout('default');
				break;
		}
		parent::display($tpl);
	}
	
	public function inputData(){
		$data['toolBar_title'] = 'Chức năng';
		$data['table'] = 'thonto_chucvu';
		$data['view'] = 'chucvu';
		return $data;
	}
	
	public function getDanhsach(){
		$data = $this->inputData();
		$vName = JRequest::getString('view');
		AdminthontoHelper::addSubmenu($vName);
		AdminthontoHelper::addButton($vName);
		
		$this->mainframe = JFactory::getApplication();
		$this->option = JRequest::getWord('option');
		$uri	= JFactory::getURI();
		
		$status = $this->mainframe->getUserStateFromRequest( $this->option.'status','status',  '', 'string' );
		$filter_order = $this->mainframe->getUserStateFromRequest( $this->option.'filter_order',	'filter_order',	'ten','cmd' );
		$filter_order_Dir = $this->mainframe->getUserStateFromRequest( $this->option.'filter_order_Dir',	'filter_order_Dir',	'',	'word' );
		$search	= $this->mainframe->getUserStateFromRequest( $this->option.'search', 'search', '', 'string');
		if (strpos($search, '"') !== false) {
			$search = str_replace(array('=', '<'), '', $search);
		}
		$search = JString::strtolower($search);
		
		if (!in_array(strtoupper($filter_order_Dir), array('ASC', 'DESC'))) {
			$filter_order_Dir = '';
		}
		$javascript 	= 'onchange="document.adminForm.submit()"';
		$lists['status']	= JHTML::_('select.genericlist',array(
															array('value'=>'','text'=>'--Trạng thái--'),
															array('value'=>'1','text'=>'Sử dụng'),
															array('value'=>'0','text'=>'Không sử dụng')
														),'status', $javascript. ' class="inputbox" size="1"', 'value', 'text', $status);
		
		
 		$model = JModelLegacy::getInstance('Chucvu','ThontoModel');
		$items = $model->listDanhsach($data['table']);
		$totals = $model->getTotal($data['table']);
		$pagination = $model->getPagination($data['table']);
		
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		$lists['search'] = $search;
		
		
		$this->sidebar = JHtmlSidebar::render();
		
		$this->assignRef('data',$data);
		$this->assignRef('lists',$lists);
		$this->assignRef('items',$items);
		$this->assignRef('pagination',$pagination);
	}
	
	public function getEditItem(){
		$id = JRequest::getInt('id',null);
		$data = $this->inputData();
		$vName = JRequest::getString('view');
		AdminthontoHelper::addButton($vName);
		
		$model = JModelLegacy::getInstance('Chucvu','ThontoModel');
		
		if($id == NULL){
			$item = array();
		}else{
			$item = $model->getEditItem($data['table'],$id);
		}
		$selected_cv = (int)$item[0]['loaihinhtochuc_id'];
		$loaihinhtochuc_id = $model->getCbo('thonto_loaihinhtochuc', 'id, ten','trangthai = 1 and id != 1','ten asc', '', '-- Nhóm chức vụ --','id','ten',$selected_cv, 'loaihinhtochuc_id', 'required');
		$this->assignRef('loaihinhtochuc_id',$loaihinhtochuc_id);
		$this->assignRef('data',$data);
		$this->assignRef('item', $item[0]);
	}
}