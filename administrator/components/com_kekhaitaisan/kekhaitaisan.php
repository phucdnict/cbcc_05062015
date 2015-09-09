<?php
/**
 * @package    Joomla.Tutorials
* @subpackage Components
* components/com_hello/hello.php
* @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_1
* @license    GNU/GPL
*/
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
// Require the base controller

require_once( JPATH_COMPONENT.'/controllers/loainha.php' );
require_once (JPATH_COMPONENT.'/helpers/kekhaitaisan.php');
require_once( JPATH_LIBRARIES.'/cbcc/Core.php' );

$document	= JFactory::getDocument();

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
KekhaitaisanHelper::addButton();
KekhaitaisanHelper::addSubmenu($controller);
// Create the controller
JRequest::setVar('view',$view);
$classname    = 'KekhaitaisanController'.ucfirst($controller);
$controller   = new $classname();

// Perform the Request task
$controller->execute( JRequest::getCmd( 'task' ) );

// Redirect if set by the controller
$controller->redirect();
