<?php
/**
 * Author: Phucnh
 * Date created: Jul 8, 2015
 * Company: DNICT
 */

class BaocaotuanControllerHello extends JControllerLegacy{
	function __construct(){
		parent::__construct();
		JRequest::setVar('view', 'hello');
		$this->registerTask('d', 'data');

	}
	function display($cachable = false, $urlparams = false) {
		parent::display();
	}
	function data(){
		echo __METHOD__;
	}
}