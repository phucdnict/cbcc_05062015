<?php
class TochucControllerTochuc extends JControllerLegacy{
	function display() {
		$document    =& JFactory::getDocument();
		$viewName    = JRequest::getVar( 'view', 'tochuc');
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
		$model = JModelLegacy::getInstance('Tochuc','TochucModel');	
		if ($model->rebuild()) {
			$this->setRedirect('index.php?option=com_tochuc&controller=tochuc','Xử lý thành công','success');
		}else{
			$this->setRedirect('index.php?option=com_tochuc&controller=tochuc','Lỗi','error');
		}
			
	}
	public function orderup(){
		$id = JRequest::getInt( 'id', 0);
		$model = JModelLegacy::getInstance('Tochuc','TochucModel');
		$result = array();
		if ($model->orderUp($id)) {
			$result['errCode'] = 0;
		}else{
			$result['errCode'] = 1;
		}
		AdminTochucHelper::printJson($result);
		//var_dump($model->orderUp($id));
		//exit;
	}
	public function orderdown(){
		$id = JRequest::getInt( 'id', 0);
		$model = JModelLegacy::getInstance('Tochuc','TochucModel');	
		$result = array();
		if ($model->orderDown($id)) {
			$result['errCode'] = 0;
		}else{
			$result['errCode'] = 1;
		}
		AdminTochucHelper::printJson($result);
		//var_dump($model->orderUp($id));
		//exit;
	}
}