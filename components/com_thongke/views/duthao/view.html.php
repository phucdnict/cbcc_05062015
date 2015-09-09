<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewDuthao extends JViewLegacy {
    function display($tpl = null) {
        $task = JRequest::getVar('task');
            switch($task){
            	case "default":		                
                	$this->setLayout('default');
                	break;
            	default:
            		$this->setLayout('hoso_404');
            		break;
  }
  parent::display($tpl);
 }
}
?>