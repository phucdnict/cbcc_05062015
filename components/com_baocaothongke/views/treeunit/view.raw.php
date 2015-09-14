<?php
class BaocaothongkeViewTreeunit extends JViewLegacy
{
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch ($task){
			case 'treeThongke':
				$this->_getTreeThongke();
				break;
			case 'getTree':
				$this->_getTree();
		}
		parent::display($tpl);
	}
	
	function _getTree($tpl = null){
		$model = JModelLegacy::getInstance('Treeunit','BaocaothongkeModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->getTree();
		}else{
			$items = array();
		}
		header("HTTP/1.0 200 OK");
		header('Content-type: application/json; charset=utf-8');
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		echo $items;
		exit;
	}
	function _getTreeThongke($tpl = null){
		$model = JModelLegacy::getInstance('Treeunit','BaocaothongkeModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewThongke($id, array('component'=>'com_baocaothongke', 'controller'=>'thongkecanbocongchucpx', 'task'=>'default'));
		}else{
			$items = array();
		}
		header("HTTP/1.0 200 OK");
		header('Content-type: application/json; charset=utf-8');
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		echo $items;
		exit;
	}


}