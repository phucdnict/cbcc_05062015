<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 */
class ThontosControllerTochuc extends ThontosController {
	function __construct() {
		parent::__construct ();
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
		$document    =& JFactory::getDocument();
        $viewName    = JRequest::getVar( 'view', 'tochuc');
        $viewLayout = JRequest::getVar( 'layout', 'default');
        $viewType   = $document->getType();    
        $view =& $this->getView( $viewName, $viewType);
        $view->setLayout($viewLayout);		
        $view->display(); 	
	}
	function savethanhlap(){
		$frmThanhLap = $_POST;
		$model = Core::model('Thonto/Tochuc');
		if ($model->savethanhlap($frmThanhLap)){
			if ($frmThanhLap['typeSave'] == 'savenew')
				$this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=thanhlap","Xử lý thành công!",'success');
			elseif ($frmThanhLap['typeSave'] == 'saveclose')
				$this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=default","Xử lý thành công!", 'success');
		}else $this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=thanhlap","Có lỗi bất thường xảy ra, vui lòng liên hệ quản trị viên!",'error');
	}
	function luusoluongkhongchuyentrach(){
		$formData = $_POST;
		$values = array();
		parse_str($formData['frm_soluongkhongchuyentrach'], $values);
		$model = Core::model('Thonto/Tochuc');
		Core::PrintJson($model->luusoluongkhongchuyentrach($values));
		die;
	}
	public function orderup(){
		$id = JRequest::getInt( 'id', 0);
		$model = Core::model('Thonto/Tochuc');
		if ($model->orderUp($id)) {
			$this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=default","Xử lý thành công!",'success');
		}else{
			$this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=default","Xử lý không thành công!",'error');
		}
	}
	public function orderdown(){
	$id = JRequest::getInt( 'id', 0);
		$model = Core::model('Thonto/Tochuc');
		if ($model->orderDown($id)) {
			$this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=default","Xử lý thành công!",'success');
		}else{
			$this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=default","Xử lý không thành công!",'error');
		}
	}
	public function xoathonto(){
		$id = JRequest::getInt('id',null);
		$model = Core::model('Thonto/Tochuc');
		if ($model->xoathonto($id))
			$this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=default","Xử lý thành công!" ,'success');
		else
			$this->setRedirect("index.php?option=com_thonto&controller=tochuc&task=default","Xử lý không thành công!",'error');
	}
}
?>