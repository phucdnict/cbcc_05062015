<?php
defined('_JEXEC') or die('Restricted access');
class DmttcnViewCachthucbonhiem extends JViewLegacy{
function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch($task){
			case 'add':
			case 'edit':
				$this->getEditItem();
				$this->setLayout('add');
				break;
			default :
//				$this->menuLienquan();
				$this->getDanhsach();
				$this->setLayout('default');
				break;
		}
		parent::display($tpl);
	}
	
	public function inputData(){
		$data['toolBar_title'] = 'Chức năng';
		$data['table'] = 'ct_cachthucbonhiem';
		$data['view'] = 'cachthucbonhiem';
		return $data;
	}
	
	public function getDanhsach(){
		$data = $this->inputData();
		$vName = JRequest::getString('view');
		$this->mainframe = JFactory::getApplication();
		$this->option = JRequest::getWord('option');
		$uri	= JFactory::getURI();
		JToolBarHelper::title('Quản lý Cách thức bổ nhiệm:','generic.png' );
		
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
		
		
 		$model = JModelLegacy::getInstance('Cachthucbonhiem','DmttcnModel');
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
		if ((int)$id <=0 ) $t='<small>[Thêm mới]</small>';
		else $t='<small>[Chỉnh sửa]</small>';
		JToolBarHelper::title('Quản lý Cách thức bổ nhiệm: ' .$t,'generic.png' );
		$model = JModelLegacy::getInstance('Cachthucbonhiem','DmttcnModel');
		
		if($id == NULL){
			$item = array();
		}else{
			$item = $model->getEditItem($data['table'],$id);
		}
		$this->assignRef('data',$data);
		$this->assignRef('item', $item[0]);
	}
}