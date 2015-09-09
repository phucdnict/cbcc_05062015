<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class BaocaotuanViewHello extends JViewLegacy {
    function display($tpl = null) {
        $task = JRequest::getVar('task');
            switch($task){
            	case "default":		                
                	$this->setLayout('syll');
                	break;
            	default:
            		$this->setLayout('default');
            		break;
  }
  parent::display($tpl);
 }
}
?>