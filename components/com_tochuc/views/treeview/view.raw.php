<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class TochucViewTreeview extends JViewLegacy{
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch ($task){
			case 'treetochuc':
				$this->_getTreeTochuc();
				break;
		}
		parent::display($tpl);
	}
	function _getTreeTochuc($tpl = null){
		$model = JModelLegacy::getInstance('Treeview','TochucModel');
		$id = JRequest::getInt('id',null);
		if($id != null){
			$items = $model->treeViewTochuc($id, array('component'=>'com_Tochuc', 'controller'=>'treeview', 'task'=>'treetochuc'));
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