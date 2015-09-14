<?php 
// defined( '_JEXEC' ) or die( 'Restricted access' );

// // Require specific controller if requested
//  require_once(JPATH_COMPONENT."/controller.php");
// require_once( JPATH_COMPONENT.'/FirePHPCore/FirePHP.class.php' );
// require_once( JPATH_COMPONENT.'/FirePHPCore/fb.php' );


// //Check controller
// fb(JRequest::getVar('controller'));
// $controller = JRequest::getVar('controller');
// if($controller) {
// 	$path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
	
// 	if (file_exists($path)) {
// 		require_once $path;
// 	} else {
// 		$controller = '';
// 	}
// }
// //Initialize controller
// $classname    = 'baocaohosoController'.$controller;

// $controller = new $classname();

// $controller->execute(JRequest::getVar("task"));

// $controller->redirect();
defined( '_JEXEC' ) or die( 'Restricted access' );
// specific controller?
// Require specific controller if requested
// require_once (JPATH_LIBRARIES.'/cbcc/Core.php');
// require_once JPATH_COMPONENT.'/helpers/TochucHelper.php';

$controller = JRequest::getWord('controller','baocaohoso');
JRequest::setVar('view',$controller);
JRequest::setVar('controller',$controller);
$path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
if (file_exists($path)) {
	require_once $path;
} else {
	$controller = 'baocaohoso';
}
// Create the controller
$classname    = 'baocaohosoController'. ucfirst($controller);
$controller   = new $classname();
// Perform the Request task
$controller->execute( JRequest::getCmd( 'task' ) );
// Redirect if set by the controller
$controller->redirect();
