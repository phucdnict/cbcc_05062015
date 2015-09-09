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
// specific controller?
// Require specific controller if requested
//require_once (JPATH_LIBRARIES.'/cbcc/Core.php');
require_once JPATH_COMPONENT.'/helpers/TochucHelper.php';

$controller = JRequest::getWord('controller','tochuc');
JRequest::setVar('view',$controller);
JRequest::setVar('controller',$controller);
$path = JPATH_COMPONENT.'/controllers/'.$controller.'.php';
if (file_exists($path)) {
	require_once $path;
} else {
	$controller = 'tochuc';
}
// Create the controller
$classname    = 'TochucController'.ucfirst($controller);
$controller   = new $classname();
// Perform the Request task
$controller->execute( JRequest::getCmd( 'task' ) );
// Redirect if set by the controller
$controller->redirect();
