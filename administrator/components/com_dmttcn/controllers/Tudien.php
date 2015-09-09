<?php
/**
 * @ Author: Phucnh
 * @ Date: May 11, 2015
 * @ File_name: tudien.php
 */
defined('_JEXEC') or die('Restricted access');
class DmttcnControllerTudien extends JControllerLegacy{
	function __construct() {
		parent::__construct();
		$this->registerTask('savenew', 'save');
		JRequest::setVar('view', 'tudien');
	}
	
	public function save(){
		$task = JRequest::getVar('task',null,'POST');
		$view = JRequest::getVar('view','');
		$model = $this->getModel('tudien','DmttcnModel');
		if ($model->storeData()) {
			$msg = 'Xử lý thành công!';
		} else {
			$msg = 'Xử lý lỗi.';
		}
		if ($task == 'savenew'){
			$link = 'index.php?option=com_dmttcn&controller='.$view.'&task=edit';
			$this->setRedirect($link, $msg);
		}else if($task == 'save') {
			$link = 'index.php?option=com_dmttcn&controller='.$view;
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
		$link = 'index.php?option=com_dmttcn&controller='.$view;
		$this->setRedirect($link, 'Hoạt động đã được hủy bỏ');
	}
	public function remove(){
		$data = JRequest::get('post');
		$tentruong = JRequest::getVar('tentruong','');
		$tenbang = JRequest::getVar('tenbang','');
		$view = JRequest::getVar('view','');
		$table = JRequest::getVar('dbtable','');
		$model = $this->getModel('tudien','DmttcnModel');
		$msg = 'Xử lý thành công!';
		if(!$model->remove($table, $tenbang, $tentruong)) $msg = 'Xử lý lỗi';
		$link = 'index.php?option=com_dmttcn&controller='.$view;
		$this->setRedirect($link, $msg);
	}
	
	public function saveorder(){
		$view = JRequest::getVar('view','');
		$model = $this->getModel('tudien','DmttcnModel');
		$msg = 'Xử lý thành công!';
		if(!$model->saveOrders()) $msg = 'Xử lý lỗi';
		$link = 'index.php?option=com_dmttcn&view='.$view;
		$this->setRedirect($link, $msg);
	}
	
	public function publish(){
		$tentruong = JRequest::getVar('tentruong','');
		$tenbang = JRequest::getVar('tenbang','');
		$view = JRequest::getVar('view','');
		$table = JRequest::getVar('dbtable','');
		$model = $this->getModel('tudien','DmttcnModel');
		$msg = 'Xử lý thành công!';
		if(!$model->publish($table,  $tenbang, $tentruong)) $msg = 'Xử lý lỗi';
		$link = 'index.php?option=com_dmttcn&controller='.$view;
		$this->setRedirect($link, $msg);
	}
	
	public function unpublish(){
		$tentruong = JRequest::getVar('tentruong','');
		$tenbang = JRequest::getVar('tenbang','');
		$view = JRequest::getVar('view','');
		$table = JRequest::getVar('dbtable','');
		$model = $this->getModel('tudien','DmttcnModel');
		$msg = 'Xử lý thành công!';
		if(!$model->unpublish($table,  $tenbang, $tentruong)) $msg = 'Xử lý lỗi';
		$link = 'index.php?option=com_dmttcn&controller='.$view;
		$this->setRedirect($link, $msg);
	}
}
		
