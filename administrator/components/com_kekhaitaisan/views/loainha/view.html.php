<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class KekhaitaisanViewLoainha extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		   case 'add':
		   case 'edit':
			    $this->getEditItem();
			    $this->setLayout('form');
			    break;
		   default :
			    $this->_default();
			    $this->setLayout('default');
			    break;
  }
  parent::display($tpl);
 }
 public function _default(){
 	$model  = Core::model('Kekhaitaisan/KktsLoainha');
 	$items  = $model->findAll();
 	$this->assignRef('items', $items);
 	$title=JRequest::getVar('title');
 	$this->assignRef('title', $title);
 	$this->sidebar = JHtmlSidebar::render();
 }
 function getEditItem(){
 	JRequest::setVar ( 'hidemainmenu', 1 );
 	$document	=	JFactory::getDocument();
 	$vName = JRequest::getString('view');
 	$row =JRequest::getVar('data');
 	@$text = (int)$row['id'] < 1 ? JText::_( 'Thêm mới' ) : JText::_( 'Hiệu chỉnh' );
 	JToolBarHelper::title(JText::_( 'Danh mục Loại nhà' ).': <small><small>[ ' . $text.' ]</small></small>','generic.png' );
 	$this->assignRef('row', $row);
 }
}

?>