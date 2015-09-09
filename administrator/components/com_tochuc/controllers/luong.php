<?php
class TochucControllerLuong extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'luong');
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
		$model = JModelLegacy::getInstance('Luong','TochucModel');
		$formData = JRequest::get('post');
		//var_dump($formData);exit;
		$goiluong_id = $model->save($formData);
		if ((int)$goiluong_id > 0 ) {
			$model->saveGoiLuongNgach($goiluong_id,$formData['ngach']);
			$this->setRedirect('index.php?option=com_tochuc&controller=luong','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=luong&task=edit&id='.$formData['id'],'Lỗi','error');
		}
			
	}
	public function delete(){
		$id =  JRequest::getInt('id',0);
		$model = JModelLegacy::getInstance('Luong','TochucModel');	
		if ($model->delete($id)) {
			$this->setRedirect('index.php?option=com_tochuc&controller=luong','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=luong','Lỗi','error');
		}			
	}
}