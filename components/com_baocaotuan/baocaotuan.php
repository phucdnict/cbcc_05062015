<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
$controller = JFactory::getApplication()->input->get('controller','tuan');
$path	=	JPATH_COMPONENT.'/controllers/'.$controller.'.php';
$helper = JPATH_COMPONENT.'/helpers/baocaotuan.php';
if (file_exists($path) && file_exists($helper)){
	require_once $path;
	require_once $helper;
}else {echo "<!DOCTYPE html>
						<html>
							<head>
								<meta charset='utf-8'/>
							</head>
							<body>
								<strong>Có lỗi xảy ra. Vui lòng liên hệ quản trị viên!!!</strong>
							<body>
						</html>"; 
		die;}

$classname  = 'BaocaotuanController'.ucfirst($controller);
$controller = new $classname();
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();