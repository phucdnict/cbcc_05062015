<?php
class ThontoControllerTochuc extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'tochuc');
		$viewLayout = JRequest::getVar( 'layout', 'default');
		$viewType   = $document->getType();
		$view =& $this->getView( $viewName, $viewType);
		$view->setLayout($viewLayout);
		$view->display();
	}
	public function rebuild(){
		$model = Core::model('Thonto/Tochuc');
		if ($model->rebuild()) {
			$this->setRedirect('index.php?option=com_thonto&controller=tochuc','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_thonto&controller=tochuc','Lỗi','error');
		}
			
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
}