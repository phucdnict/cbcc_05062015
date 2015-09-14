<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
//import view parent class
class baocaohosoViewbaocaohoso extends JViewLegacy
{
	function display($tpl = null)
	{	
		$document = &JFactory::getDocument();
		
		//$document->addCustomTag('<link rel="stylesheet" href="'.JURI::base(true) . '/components/com_baocaohoso/css/jquery-ui-1.10.3.custom.min.css" />');
		
		$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaohoso/js/jstree/jquery.jstree.js" type="text/javascript"></script>');
		$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaohoso/js/jstree/_lib/jquery.cookie.js" type="text/javascript"></script>');
		$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaohoso/js/bootstrap-datepicker.min.js" type="text/javascript"></script>');
		//$document->addCustomTag('<link rel="stylesheet" href="'.JURI::base(true) . '/components/com_baocaohoso/css/datepicker.css" />');
		$document->addCustomTag('<link rel="stylesheet" href="'.JURI::base(true) .'/components/com_baocaohoso/css/jquery.treeview.css" />');
// 		$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaohoso/js/jquery.blockUI.js" type="text/javascript"></script>');
		
 		$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaohoso/controller.js" type="text/javascript"></script>');		
 		$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaohoso/myjs/shareLib.js" type="text/javascript"></script>');
        parent::display($tpl);   
	}  

	
}