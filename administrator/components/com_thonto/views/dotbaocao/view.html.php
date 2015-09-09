<?php
defined('_JEXEC') or die('Restricted access');
class ThontoViewDotbaocao extends JViewLegacy{
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
			case 'configdot':
				$this->configdot();
				$this->setLayout('configdot');
				break;
			default :
				$this->getDanhsach();
				$this->setLayout('default');
				break;
		}
		parent::display($tpl);
	}
	public function configdot(){
		$id = JRequest::getInt('id',null);
		$data = $this->inputData();
		$vName = JRequest::getString('view');
		
		AdminThontoHelper::addButton($vName);
		$model = JModelLegacy::getInstance('Dotbaocao','ThontoModel');
		
		if($id == NULL){
			$item = array();
		}else{
			$item = $model->getEditItem($data['table'],$id);
		}
		$kiennghi = $model->getKiennghi();
		$fk = $model->getFk_Dot_Kiennghi($id);
		$noidunghop = $model->getNoidunghop();
		$fk_noidunghop = $model->getFk_Dot_Noidunghop($id);
		
		$this->assignRef('fk',$fk);
		$this->assignRef('kiennghi',$kiennghi);
		$this->assignRef('fk_noidunghop',$fk_noidunghop);
		$this->assignRef('noidunghop',$noidunghop);
		$this->assignRef('data',$data);
		$this->assignRef('item', $item[0]);
	} 
	public function inputData(){
		$data['toolBar_title'] = 'Chức năng';
		$data['table'] = 'thonto_dotbaocao';
		$data['view'] = 'dotbaocao';
		return $data;
	}
	
	public function getDanhsach(){
		$data = $this->inputData();
		$vName = JRequest::getString('view');
		AdminThontoHelper::addSubmenu($vName);
		AdminThontoHelper::addButton($vName);
		
		$this->mainframe = JFactory::getApplication();
		$this->option = JRequest::getWord('option');
		$uri	= JFactory::getURI();
		
		$status = $this->mainframe->getUserStateFromRequest( $this->option.'status','status',  '', 'string' );
		$filter_order = $this->mainframe->getUserStateFromRequest( $this->option.'filter_order',	'filter_order',	'tendot','cmd' );
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
		
		
 		$model = JModelLegacy::getInstance('Dotbaocao','ThontoModel');
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
		AdminThontoHelper::addButton($vName);
// 		JToolBarHelper::title('Edit','generic.png' );
		
		$model = JModelLegacy::getInstance('Dotbaocao','ThontoModel');
		
		if($id == NULL){
			$item = array();
		}else{
			$item = $model->getEditItem($data['table'],$id);
		}
		$this->assignRef('data',$data);
		$this->assignRef('item', $item[0]);
	}
}