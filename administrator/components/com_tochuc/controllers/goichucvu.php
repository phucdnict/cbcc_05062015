<?php
class TochucControllerGoichucvu extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'cap');
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
		$model = JModelLegacy::getInstance('Goichucvu','TochucModel');
		$formData = JRequest::get('post');
		//var_dump($formData);exit;
		$goichucvu_id = $model->save($formData);
		if ($goichucvu_id) {
			$model->saveGoichucvuChucvu($goichucvu_id,$formData);
			$this->setRedirect('index.php?option=com_tochuc&controller=goichucvu','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goichucvu&task=edit&id='.$formData['id'],'Lỗi','error');
		}
			
	}
	public function rebuild(){
		$model = JModelLegacy::getInstance('Goichucvu','TochucModel');		
		//var_dump($model->delete($id));exit;
		if ($model->rebuild()) {
			$this->setRedirect('index.php?option=com_tochuc&controller=goichucvu','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goichucvu','Lỗi','error');
		}
			
	}
	public function delete(){		
		$model = JModelLegacy::getInstance('Goichucvu','TochucModel');
		$id = JRequest::getInt('id');
		//var_dump($model->delete($id));exit;
		if ($model->delete($id)) {
			$model->deleteGoichucvuChucvu($id);
			$this->setRedirect('index.php?option=com_tochuc&controller=goichucvu','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goichucvu','Lỗi','error');
		}
			
	}
	public function movenode(){
		$formData = JRequest::get('post');
		$id = JRequest::getInt('id',0);
		$parent_id = JRequest::getInt('ref',0);		
		$model = JModelLegacy::getInstance('Goichucvu','TochucModel');
		$result = array();
		if ($model->moveNode($id,$parent_id)) {
			$result['status'] = true;
		}else{
			$result['status'] = false;
		}
		AdminTochucHelper::printJson($result);
	}	
}