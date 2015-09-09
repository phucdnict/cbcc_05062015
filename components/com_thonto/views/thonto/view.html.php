<?php
defined('_JEXEC') or die('Restricted access');
class ThontosViewThonto extends JViewLegacy{
	function display($tpl = null){
		$task = JRequest::getVar('task','default');
		switch ($task){	
			default :
				$this->initDefault();
				break;
		}
		parent::display($tpl);
	}
	public function initDefault(){
		$document = JFactory::getDocument();
		$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/css/jquery.fileupload.css" rel="stylesheet" />');
		$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/css/colorbox.css" rel="stylesheet" />');
		$document->addStyleSheet(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
		$document->addStyleSheet(JURI::root(true).'/media/cbcc/js/jquery/select2/select2.css');
		$document->addStyleSheet(JURI::root(true).'/media/cbcc/js/jquery/select2/select2-bootstrap.css');
		$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.bootstrap.js');		
		$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.tableTools.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/datatables.default.config.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/bootstrap.tab.ajax.js');
		$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/select2/select2.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/select2/select2_locale_vi.js');
		$document->addScript(JURI::base(true).'/components/com_hoso/js/hoso_tiepnhanlai.js' );
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.autosize-min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.slimscroll.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/upload/jquery.iframe-transport.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/upload/jquery.fileupload.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/jquery.colorbox-min.js');
		$model = Core::model('Thonto/Hoso');
		$idUser = JFactory::getUser()->id;
		// Kiểm tra và lấy thông tin node Root cây tổ chức hồ sơ
		$idRoot = '1';
		if($idRoot == null){
			$this->setLayout('hoso_404');
		}else{
			$id_donvi = $model->getInfoOfRootTree($idRoot);
			$this->assignRef('id_donvi', $id_donvi);
			$this->assignRef('idUser', $idUser);
		}
	}
}