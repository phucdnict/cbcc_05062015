<?php
/**
 * Author: Phucnh
 * Date created: Aug 11, 2015
 * Company: DNICT
 */
require_once JPATH_COMPONENT.'/helpers/ThontoHelper.php';
$controller = JRequest::getWord('controller','chibo');
JRequest::setVar('view',$controller);
JRequest::setVar('controller',$controller);
$path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
if (file_exists($path)) {
	require_once $path;
} else {
	$controller = 'chibo';
	$path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
	require_once $path;
}
// Create the controller
$classname    = 'ThontoController'.ucfirst($controller);
$controller   = new $classname();
// Perform the Request task
$controller->execute( JRequest::getCmd( 'task' ) );
// Redirect if set by the controller
$controller->redirect();
