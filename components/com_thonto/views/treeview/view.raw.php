<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewTreeview extends JViewLegacy{
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch ($task){
			case 'treeview':
				$this->_getTreeview();
				break;
			case 'treeThonto':
				$this->treeThonto();
				break;
			case 'treeViewTochuc':
				$this->treeViewTochuc();
				break;
			case 'treeQuanhuyen':
				$this->treeQuanhuyen();
				break;
			case 'treePhuongxa':
				$this->treePhuongxa();
				break;
			default :
				$this->_initDefault();
				break;
		}
		parent::display($tpl);
	}
	function _getTreeview($tpl = null){
		$model = Core::model('Thonto/Hoso');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeView($id);
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
	function treePhuongxa($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','ThontosModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeThonto($id, array('condition'=>'kieu NOT IN (4,5)'));
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
	function treeQuanhuyen($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','ThontosModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeThonto($id, array('condition'=>'kieu NOT IN (3,4,5)'));
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
	function treeThonto($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','ThontosModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeThonto($id);
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
	function treeViewTochuc($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','ThontosModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewTochuc($id);
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