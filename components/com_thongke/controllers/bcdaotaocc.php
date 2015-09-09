<?php
/**
 * Author: Phucnh
 * Date created: Apr 15, 2015
 * Company: DNICT
 * TỔNG HỢP KẾT QUẢ ĐÀO TẠO BỒI DƯỠNG CÁN BỘ, CÔNG CHỨC
 */
class ThongkeControllerBcdaotaocc extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
		JRequest::setVar('view', 'bcdaotaocc');
		$user = & JFactory::getUser ();
		if ($user->id == null) {
			if (JRequest::getVar('format') == 'raw') {
				echo '<script> window.location.href="index.php?option=com_users&view=login"; </script>';
				exit;
			}else{
				$this->setRedirect ( "index.php?option=com_users&view=login" );
			}
		}
	}
	function display($cachable = false, $urlparams = false) {
		parent::display();
	}
}
?>