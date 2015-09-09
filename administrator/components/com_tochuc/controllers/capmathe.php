<?php
class TochucControllerCapmathe extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'capmathe');
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
		//var_dump($formData);exit;		
		if((int)$formData['node_id'] > 0){
			$db = Core::db();
			for ($i = 0,$n=count($formData['pos_system']); $i < $n; $i++) {
				$sql = 'UPDATE cb_goichucvu_chucvu SET chophep_inthe = 1 WHERE goichucvu_id = '
						.$db->quote((int)$formData['node_id'])
						.' AND pos_system_id = '.$db->quote($formData['pos_system'][$i])
				;
				$db->setQuery($sql);
				$db->query();
			}
			
		}
		$this->setRedirect('index.php?option=com_tochuc&controller=capmathe','Xử lý thành công','success');
			
	}
}