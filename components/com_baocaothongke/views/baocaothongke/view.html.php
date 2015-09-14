<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
//import view parent class
class BaocaochatluongViewbaocaohoso extends JViewLegacy
{
	function display($tpl = null)
	{	
		$document = &JFactory::getDocument();
		
		//$document->addCustomTag('<link rel="stylesheet" href="'.JURI::base(true) . '/components/com_baocaochatluong/css/jquery-ui-1.10.3.custom.min.css" />');
		$document->addScript(JURI::root(true).'/media/cbcc/js/bootstrap.tab.ajax.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.cookie.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');   
    	$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
		//$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaochatluong/js/jstree/_lib/jquery.cookie.js" type="text/javascript"></script>');
		//$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaochatluong/js/bootstrap-datepicker.min.js" type="text/javascript"></script>');
		//$document->addCustomTag('<link rel="stylesheet" href="'.JURI::base(true) . '/components/com_baocaochatluong/css/datepicker.css" />');
		//$document->addCustomTag('<link rel="stylesheet" href="'.JURI::base(true) .'/components/com_baocaochatluong/css/jquery.treeview.css" />');
// 		$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaochatluong/js/jquery.blockUI.js" type="text/javascript"></script>');
		
 		//$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaochatluong/controller.js" type="text/javascript"></script>');		
 		//$document->addCustomTag('<script src="'.JURI::base(true) . '/components/com_baocaochatluong/myjs/shareLib.js" type="text/javascript"></script>');
        parent::display($tpl);   
	}  

	
}