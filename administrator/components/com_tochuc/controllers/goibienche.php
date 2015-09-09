<?php
class TochucControllerGoibienche extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'goibienche');
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
		$model = JModelLegacy::getInstance('Goibienche','TochucModel');
		$formData = JRequest::get('post');
		//var_dump($formData);exit;
		$goibienche_id = $model->save($formData);
		if ($goibienche_id) {
			$model->deleteGoibiencheHinhthuc($goibienche_id);
			for ($i = 0; $i < count($formData['hinhthuc_id']); $i++) {
				$strDieuDongId =  $formData['hinhthucdieudong_id'][$formData['hinhthuc_id'][$i]];
				$data = array(
						'goibienche_id'=>$goibienche_id,
						'hinhthuc_id'=>$formData['hinhthuc_id'][$i]						
				);
				if ($strDieuDongId != NULL) {
					$data['hinhthucdieudong_id'] = implode(',',$strDieuDongId);
				}
				$model->saveGoibiencheHinhthuc($data);
				//var_dump($data);
			}				
			//exit;
			$this->setRedirect('index.php?option=com_tochuc&controller=goibienche','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goibienche&task=edit&id='.$formData['id'],'Lỗi','error');
		}
			
	}
	public function delete(){
		$model = JModelLegacy::getInstance('Goibienche','TochucModel');
		$id = JRequest::getInt('id');
		//var_dump($model->delete($id));exit;
		if ($model->delete($id)) {
			$this->setRedirect('index.php?option=com_tochuc&controller=goibienche','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goibienche','Lỗi','error');
		}
			
	}
}