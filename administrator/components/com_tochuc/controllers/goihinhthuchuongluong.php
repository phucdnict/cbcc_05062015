<?php
class TochucControllerGoihinhthuchuongluong extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'goihinhthuchuongluong');
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
		$model = JModelLegacy::getInstance('Goihinhthuchuongluong','TochucModel');
		$formData = JRequest::get('post');
		$goihinhthuchuongluong_id = $model->save($formData);
		if ($goihinhthuchuongluong_id) {
			$model->deleteGoihinhthuchuongluongNangluong($goihinhthuchuongluong_id);
			for ($i = 0; $i < count($formData['whois_sal_mgr_id']); $i++) {
				$data = array(
						'goihinhthuchuongluong_id'=>$goihinhthuchuongluong_id,
						'whois_sal_mgr_id'=>$formData['whois_sal_mgr_id'][$i]	
				);
				$model->saveGoihinhthuchuongluongNangluong($data);
			}				
			$this->setRedirect('index.php?option=com_tochuc&controller=goihinhthuchuongluong','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goihinhthuchuongluong&task=edit&id='.$formData['id'],'Lỗi','error');
		}
			
	}
	public function delete(){
		$model = JModelLegacy::getInstance('Goihinhthuchuongluong','TochucModel');
		$id = JRequest::getInt('id');
		if ($model->delete($id)) {
			$this->setRedirect('index.php?option=com_tochuc&controller=goihinhthuchuongluong','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=goihinhthuchuongluong','Lỗi','error');
		}
			
	}
}