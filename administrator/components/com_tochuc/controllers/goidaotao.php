<?php
class TochucControllerGoidaotao extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'goidaotao');
		// Get some vars for the view
		$viewLayout = JRequest::getVar( 'layout', 'default');
		//var_dump($viewLayout);
		$viewType   = $document->getType();
		// Get the view
		$view =& $this->getView( $viewName, $viewType);
		// Set the layout
		$view->setLayout($viewLayout);
		$view->display();
	}
	public function saveedit(){
		JSession::checkToken() or die( 'Invalid Token' );		
		$formData = JRequest::get('post');
		$model =  Core::model('Danhmuc/CbGoidaotaoboiduong');		
		if ($model->save($formData)) {			
			$this->setRedirect('index.php?option=com_tochuc&controller=goidaotao','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goidaotao&task=edit&id='.$formData['id'],'Lỗi','error');
		}
			
	}
	public function delete(){
		$model =  Core::model('Danhmuc/CbGoidaotaoboiduong');
		$id = JRequest::getInt('id');
		if ($model->delete($id)) {
			$this->setRedirect('index.php?option=com_tochuc&controller=goidaotao','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goidaotao','Lỗi','error');
		}
			
	}
}