<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
/*
 * Make sure the user is authorized to view this page
 */
require_once( JPATH_COMPONENT.'/controller.php' );
require_once (JPATH_COMPONENT.'/helpers/kekhaitaisan.php');
$document	= JFactory::getDocument();

$document->addStyleSheet(JURI::base(true).'/media/cbcc/js/jstree/themes/default/style.css');
//validate
$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
$controller = JRequest::getWord('controller');
$view = JRequest::getWord('view');
if ($controller == '' && $view !='') {
	$controller = $view;
}
if ($controller != '' && $view =='') {
	$view = $controller;
}
JRequest::setVar('controller',$controller);
$path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
if (file_exists($path)) {
	require_once $path;
} else {
	$controller = '';
}
// Create the controller
JRequest::setVar('view',$view);
$classname    = 'KekhaitaisanController'.ucfirst($controller);
$controller   = new $classname();

// Perform the Request task
$controller->execute( JRequest::getCmd( 'task' ) );

// Redirect if set by the controller
$controller->redirect();
