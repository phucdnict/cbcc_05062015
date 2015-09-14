<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class BaocaothongkeViewThongkecanbocongchucpx extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
		  	default:
		  		$this->setLayout('hoso_404');
		  		break;
  }
  parent::display($tpl);
 }
}
?>