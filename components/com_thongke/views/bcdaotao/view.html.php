<?php
class ThongkeViewBcdaotao extends JViewLegacy {
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
 public function defaults(){
 	$document = JFactory::getDocument();
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.maskedinput.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/upload/jquery.fileupload.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery.colorbox-min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/upload/jquery.iframe-transport.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/date-time/bootstrap-datepicker.min.js');
 	$document->addScript(JUri::base(true).'/media/cbcc/js/bootstrap.tab.ajax.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
 	$document->addScript( JURI::base(true).'/media/cbcc/js/caydonvi.js' );
 	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.bootstrap.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.tableTools.min.js');
 	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/datatables.default.config.js');
 	$document->addStyleSheet(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
 }
}
?>