<?php
class TochucControllerGoiluong extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'goiluong');
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
	public function rebuild(){
		$model = JModelLegacy::getInstance('Goiluong','TochucModel');
		//var_dump($model->delete($id));exit;
		if ($model->rebuild()) {
			$this->setRedirect('index.php?option=com_tochuc&controller=goiluong','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goiluong','Lỗi','error');
		}
			
	}
	public function saveedit(){
		JSession::checkToken() or die( 'Invalid Token' );
		$model = JModelLegacy::getInstance('Goiluong','TochucModel');
		$formData = JRequest::get('post');
		//var_dump($formData);exit;
		$goiluong_id = $model->save($formData);
		if ((int)$goiluong_id > 0 ) {
			$model->saveGoiLuongNgach($goiluong_id,$formData['ngach']);
			$this->setRedirect('index.php?option=com_tochuc&controller=goiluong','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goiluong&task=edit&id='.$formData['id'],'Lỗi','error');
		}
			
	}
	public function delete(){
		$id =  JRequest::getInt('id',0);
		$model = JModelLegacy::getInstance('Goiluong','TochucModel');	
		if ($model->delete($id)) {
			$this->setRedirect('index.php?option=com_tochuc&controller=goiluong','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goiluong','Lỗi','error');
		}			
	}
	public function movenode(){
		$formData = JRequest::get('post');
		$id = JRequest::getInt('id',0);
		$parent_id = JRequest::getInt('ref',0);
		$model = JModelLegacy::getInstance('Goiluong','TochucModel');
		$result = array();
		if ($model->moveNode($id,$parent_id)) {
			$result['status'] = true;
		}else{
			$result['status'] = false;
		}
		AdminTochucHelper::printJson($result);
	}
}