<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class KekhaitaisanViewTaisan extends JViewLegacy {
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
 	$title=JRequest::getVar('title');
 	$this->assignRef('title', $title);
 	$model  = Core::model('Kekhaitaisan/KktsTaisan');
 	$items  = $model->findAll();
 	$this->assignRef('items', $items);
 	$this->sidebar = JHtmlSidebar::render();
 }
 function getEditItem(){
 	JRequest::setVar ( 'hidemainmenu', 1 );
 	$document	=	JFactory::getDocument();
 	$row =JRequest::getVar('data');
 	@$text = (int)$row['id'] < 1 ? JText::_( 'Thêm mới' ) : JText::_( 'Hiệu chỉnh' );
 	JToolBarHelper::title(JText::_( 'Danh mục Tài sản' ).': <small><small>[ ' . $text.' ]</small></small>','generic.png' );
 	$this->assignRef('row', $row);
 }
}

?>