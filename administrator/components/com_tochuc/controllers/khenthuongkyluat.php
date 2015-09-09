<?php
/**
 * @ Author: Phucnh
 * @ Date: May 11, 2015
 * @ File_name: khenthuongkyluat.php
 */
defined('_JEXEC') or die('Restricted access');
class TochucControllerKhenthuongkyluat extends JControllerLegacy{
function __construct() {
		parent::__construct();
		$this->registerTask('savenew', 'save');
	}
	
	public function save(){
		$task = JRequest::getVar('task',null,'POST');
		$view = JRequest::getVar('view','');
		$model = $this->getModel('khenthuongkyluat','TochucModel');
		if ($model->storeData()) {
			$msg = 'Xử lý thành công!';
		} else {
			$msg = 'Xử lý lỗi.';
		}
		if ($task == 'savenew'){
			$link = 'index.php?option=com_tochuc&controller='.$view.'&task=edit';
			$this->setRedirect($link, $msg);
		}else if($task == 'save') {
			$link = 'index.php?option=com_tochuc&controller='.$view;
			$this->setRedirect($link, $msg);
		}else{
			$post = JRequest::get( 'post' );
			JRequest::setVar('post',$post);
			JRequest::setVar( 'view', $view );
			JRequest::setVar( 'layout', 'edit');
			parent::display();
		}
	}
	
	public function cancel(){
		$view = JRequest::getVar('view','');
		$link = 'index.php?option=com_tochuc&controller='.$view;
		$this->setRedirect($link, 'Hoạt động đã được hủy bỏ');
	}
	public function remove(){
		$id = JRequest::getInt('id', null);
		$view = JRequest::getVar('view','');
		$table = JRequest::getVar('dbtable','');
		if($id == NULL){
			$cid = JRequest::getVar('cid', array(0), 'post', 'array');
		}else{
			$cid[] = $id;
		}
		$model = $this->getModel('khenthuongkyluat','TochucModel');
		$msg = 'Xử lý thành công!';
		if(!$model->remove($table, $cid)) $msg = 'Xử lý lỗi';
		$link = 'index.php?option=com_tochuc&controller='.$view;
		$this->setRedirect($link, $msg);
	}
	
	public function saveorder(){
		$view = JRequest::getVar('view','');
		$model = $this->getModel('khenthuongkyluat','TochucModel');
		$msg = 'Xử lý thành công!';
		if(!$model->saveOrders()) $msg = 'Xử lý lỗi';
		$link = 'index.php?option=com_tochuc&view='.$view;
		$this->setRedirect($link, $msg);
	}
	
	public function publish(){
		$id = JRequest::getInt('id', null);
		$view = JRequest::getVar('view','');
		$table = JRequest::getVar('dbtable','');
		if($id == NULL){
			$cid = JRequest::getVar('cid', array(0), 'post', 'array');
		}else{
			$cid[] = $id;
		}
		$model = $this->getModel('khenthuongkyluat','TochucModel');
		$msg = 'Xử lý thành công!';
		if(!$model->publish($table, $cid)) $msg = 'Xử lý lỗi';
		$link = 'index.php?option=com_tochuc&controller='.$view;
		$this->setRedirect($link, $msg);
	}
	
	public function unpublish(){
		$id = JRequest::getInt('id', null);
		$view = JRequest::getVar('view','');
		$table = JRequest::getVar('dbtable','');
		if($id == NULL){
			$cid = JRequest::getVar('cid', array(0), 'post', 'array');
		}else{
			$cid[] = $id;
		}
		$model = $this->getModel('khenthuongkyluat','TochucModel');
		$msg = 'Xử lý thành công!';
		if(!$model->unpublish($table, $cid)) $msg = 'Xử lý lỗi';
		$link = 'index.php?option=com_tochuc&controller='.$view;
		$this->setRedirect($link, $msg);
	}
}
		
