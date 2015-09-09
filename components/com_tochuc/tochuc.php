<?php
// defined( '_JEXEC' ) or die( 'Restricted access' );
// require_once JPATH_COMPONENT.'/helpers/tochuc.php';
// $controller = JRequest::getWord('controller','tochuc');
// JRequest::setVar('view',$controller);
// JRequest::setVar('controller',$controller);
// $path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
// if (file_exists($path)) {
// 	require_once $path;
// } else {
// 	$controller = 'tochuc';
// }
// // Create the controller
// $classname    = 'TochucController'.ucfirst($controller);
// // var_dump($controller);exit;
// $controller   = new $classname();
// // Perform the Request task
// $controller->execute( JRequest::getCmd( 'task' ) );
// // Redirect if set by the controller
// $controller->redirect();
defined( '_JEXEC' ) or die( 'Restricted access' );
$controller = JFactory::getApplication()->input->get('controller','tochuc');
require_once (JPATH_COMPONENT.'/controllers/'.$controller.'.php');
require_once JPATH_COMPONENT.'/helpers/Tochuc.php';
$classname  = 'TochucController'.ucfirst($controller);
$controller = new $classname();
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();