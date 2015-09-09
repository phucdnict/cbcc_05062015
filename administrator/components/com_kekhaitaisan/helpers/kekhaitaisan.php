<?php
defined('_JEXEC') or die;

class KekhaitaisanHelper
{
	public static function addButton(){
		$task=JRequest::getVar('task');
		$controller=JRequest::getVar('controller');
		switch (strtoupper($controller)){
			case 'LOAINHA':
				$title='Loại nhà';
				break;
			case 'CAPCONGTRINH':
				$title='Cấp công trình';
				break;
			case 'TAISAN':
				$title='Tài sản';
				break;
			default:
				$title='';
				break;
		}
		switch ($task)
		{
			case 'add' :
			case 'edit':
				JToolBarHelper::save('save','Lưu và đóng');
				JToolBarHelper::cancel('cancel','Huỷ bỏ');
				break;
			default:
				JToolBarHelper::title(JText::_('Danh mục '.($title).': [Danh sách]'), 'generic.png' );
				JToolBarHelper::addNew('add','Thêm mới');
				JToolBarHelper::deleteList(null,'remove','Xóa');
				JToolBarHelper::publish('publish','Bật trạng thái');
				JToolBarHelper::unpublish('unpublish','Tắt trạng thái');
				break;
		}		
	}
	
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(JText::_('Loại nhà'),'index.php?option=com_kekhaitaisan&controller=loainha',$vName == 'loainha');
		JHtmlSidebar::addEntry(JText::_('Cấp công trình'),'index.php?option=com_kekhaitaisan&controller=capcongtrinh',$vName == 'capcongtrinh');
		JHtmlSidebar::addEntry(JText::_('Tài sản'),'index.php?option=com_kekhaitaisan&controller=taisan',$vName == 'taisan');
	}
}