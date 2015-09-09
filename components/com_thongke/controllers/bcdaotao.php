<?php
/**
 * Author: Phucnh
 * Date created: Aug 5, 2015
 * Company: DNICT
 */
class ThongkeControllerBcdaotao extends JControllerLegacy {
	function __construct(){
		parent::__construct();
		JRequest::setVar('view', 'bcdaotao');
	}
	function display($cachable = false, $urlparams = false) {
		parent::display();
	}
}