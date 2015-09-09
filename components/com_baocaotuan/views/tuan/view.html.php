<?php
/**
 * Author: Phucnh
 * Date created: Mar 19, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class BaocaotuanViewTuan extends JViewLegacy {
    function display($tpl = null) {
        $task = JRequest::getVar('task');
            switch($task){
            	case 'default':
                    $this->setLayout('default');
                    $this->defaults();
                    break;
                default:		                
                	$this->setLayout('hoso_404');
                	break;
  }
  parent::display($tpl);
 }
 function defaults(){
 	$document = JFactory::getDocument();
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
 	$document->addScript( JURI::root(true) . '/media/cbcc/js/jquery.maskedinput.min.js' );
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
 	
 	$document->addStyleSheet(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.bootstrap.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.tableTools.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/datatables.default.config.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
	// switch
 	$document->addStyleSheet(JURI::base(true).'/media/cbcc/zxbaocao/datepicker.css');
 	$document->addScript(JURI::base(true).'/media/cbcc/zxbaocao/bootstrap_switch/js/bootstrap-switch.min.js');
 	$document->addStyleSheet(JURI::base(true).'/media/cbcc/zxbaocao/bootstrap_switch/css/bootstrap3/bootstrap-switch.min.css');
 	// date range
 	$document->addScript(JURI::base(true).'/media/cbcc/zxbaocao/bootstrap_daterangepicker/js/moment.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/zxbaocao/bootstrap_daterangepicker/js/daterangepicker.js');
 	$document->addStyleSheet(JURI::base(true).'/media/cbcc/zxbaocao/bootstrap_daterangepicker/css/daterangepicker_bs2.css');
 	// jquery-labelauty
 	$document->addScript(JURI::base(true).'/media/cbcc/zxbaocao/jquery-labelauty/js/jquery-labelauty.js');
 	$document->addStyleSheet(JURI::base(true).'/media/cbcc/zxbaocao/jquery-labelauty/css/jquery-labelauty.css');
 	// time picker
 	$document->addScript(JURI::base(true).'/media/cbcc/zxbaocao/timepicker/js/jquery.datetimepicker.js');
 	$document->addStyleSheet(JURI::base(true).'/media/cbcc/zxbaocao/timepicker/css/jquery.datetimepicker.css');
 }
}
?>