<?php
class TochucControllerTochuc extends  JControllerLegacy {
    function __construct($config = array()) {
		parent::__construct ( $config );
		$user = & JFactory::getUser ();
    	if ($user->id == null) {
			//var_dump(JRequest::getVar('format'));exit;
			if (JRequest::getVar('format') == 'raw') {
				echo '<script> window.location.href="index.php?option=com_users&view=login"; </script>';
				exit;
			}else{
				$this->setRedirect ( "index.php?option=com_users&view=login" );
			}
		}
	}
	function display() {         
 		$document    =& JFactory::getDocument();
        $viewName    = JRequest::getVar( 'view', 'tochuc');
        // Get some vars for the view
        $viewLayout = JRequest::getVar( 'layout', 'default');
        $viewType   = $document->getType();    
        // Get the view
        $view =& $this->getView( $viewName, $viewType);
        // Set the layout
        $view->setLayout($viewLayout);		
        $view->display(); 	
	}
	
	public function savethanhlap(){
		JSession::checkToken() or die( 'Invalid Token' );
		$user = JFactory::getUser();
		if(Core::_checkPerAction($user->id,'com_tochuc','tochuc','thanhlap') == false){
			JFactory::getApplication()->enqueueMessage('Bạn không có quyền truy cập','error');
			$this->setRedirect ( "index.php");
			return;
		}
		$model = Core::model('Tochuc/Tochuc');
		$formData = JRequest::get('post');
		try {
			if ($formData['chkrep_hc_name'] == 1) {
				$formData['rep_hc_parent_id'] = $formData['parent_id'];
				$formData['rep_hc_name'] = Core::loadResult('ins_dept', array('name'), array('id = '=>$formData['parent_id']));
			}else{
				unset($formData['rep_hc_parent_id']);
			}
			if ($formData['chkrep_sn_name'] == 1) {
				$formData['rep_sn_parent_id'] = $formData['parent_id'];
				$formData['rep_sn_name'] = Core::loadResult('ins_dept', array('name'), array('id = '=>$formData['parent_id']));
			}else{
				unset($formData['rep_sn_parent_id']);
			}
			$id = $model->saveDept($formData);
			$model->saveLinhvuc($id,$formData['ins_linhvuc']);
			//var_dump($id);exit;
			//if($formData['id'])
			$vanban_created = $formData['vanban_created'];
			if (strlen($vanban_created['mahieu']) > 0 ) {
				$vanban_created['tieude'] = 'QĐ '.TochucHelper::getNameById($formData['type_created'], 'ins_dept_cachthuc').' ,Ngày '.$formData['date_created'];
				$vanban_id = $model->saveVanban(array(
						'id'=>$vanban_created['id'],
						'mahieu'=>$vanban_created['mahieu'],
						'tieude'=>$vanban_created['tieude'],
						'ngaybanhanh'=>$vanban_created['ngaybanhanh'],
						'coquan_banhanh_id'=>$vanban_created['coquan_banhanh_id'],
						'coquan_banhanh'=>$vanban_created['coquan_banhanh']
				));
	    		$mapperAttachment = Core::model('Core/Attachment');
				for ($i = 0,$n=count($formData["idFile-tochuc-attachment"]); $i < $n; $i ++) {
					$mapperAttachment->updateTypeIdByCode($formData["idFile-tochuc-attachment"][$i],1,true,$vanban_id);
				}
// 				$model->saveTaptin($vanban_id,$formData['fileupload_id']);
				$dataUpdate = array('vanban_created'=>$vanban_id,'id'=>$id);
				Core::update('ins_dept', $dataUpdate, 'id');				
			}

			if ((int)$formData['id'] == 0) {
				// them moi
				$model->saveQuatrinh(array(
						'quyetdinh_so'=>$formData['number_created'],
						'quyetdinh_ngay'=>$formData['date_created'],
						'ghichu'=>$formData['ghichu'],
						'chitiet'=>TochucHelper::getNameById($formData['type_created'], 'ins_dept_cachthuc').' '.$formData['name'],
						'name'=>$formData['name_created'],
						'hieuluc_ngay'=>TochucHelper::strDateVntoMySql($formData['date_created']),
						'dept_id'=>$id,
						'cachthuc_id'=>$formData['type_created'],
						'ordering'=>1,
						'vanban_id'=>$vanban_id
				));
				$message = 'Thêm mới thành công';
			}
			else{
				// edit
				$message = 'Hiệu chỉnh thành công';
			}
			if ((int)$formData['active'] != 1) {
				$trangthai_file = $formData['trangthai_fileupload_id'];
				$formTrangThai = $formData['trangthai'];
				$formTrangThai['tieude'] = 'QĐ '.TochucHelper::getNameById($formData['active'], 'ins_status').' ,Ngày '.$formTrangThai['quyetdinh_ngay'];
				$trangthai_vanban_id = $model->saveVanban(array(
					'id'=>$formTrangThai['id'],
					'mahieu'=>$formTrangThai['mahieu'],
					'tieude'=>$formTrangThai['tieude'],
					'ngaybanhanh'=>$formTrangThai['ngaybanhanh'],
					'coquan_banhanh_id'=>$formTrangThai['coquan_banhanh_id'],
					'coquan_banhanh'=>$formTrangThai['coquan_banhanh']
							
				));
	    		$mapperAttachment = Core::model('Core/Attachment');
				for ($i = 0,$n=count($formData["idFile-trangthai-attachment"]); $i < $n; $i ++) {
					$mapperAttachment->updateTypeIdByCode($formData["idFile-trangthai-attachment"][$i],1,true,$trangthai_vanban_id);
				}
// 				$model->saveTaptin($trangthai_vanban_id,$trangthai_file);
				Core::update('ins_dept', array('vanban_active'=>$trangthai_vanban_id,'id'=>$id), 'id');
				if ((int)$formData['id'] == 0) {			
					$model->saveQuatrinh(array(
							'quyetdinh_so'=>$formTrangThai['quyetdinh_so'],
							'quyetdinh_ngay'=>$formTrangThai['quyetdinh_ngay'],
							'chitiet'=>TochucHelper::getNameById($formData['active'], 'ins_status').' '.$formData['name'],
							'name'=>$formData['name'],
							'hieuluc_ngay'=>TochucHelper::strDateVntoMySql($formTrangThai['quyetdinh_ngay']),
							'dept_id'=>$id,
							'cachthuc_id'=>$formData['active'],
							'ordering'=>99,
							'vanban_id'=>$trangthai_vanban_id
					));
				}

			}
			JFactory::getApplication()->enqueueMessage($message);
		} catch (Exception $e) {
			JFactory::getApplication()->enqueueMessage($e->__toString(),'error');
		}
		if ($formData['action_name']=='SAVEANDCLOSE') {
			$this->setRedirect ( "index.php?option=com_tochuc&controller=tochuc&task=default");
		}else{
			$this->setRedirect ( "index.php?option=com_tochuc&controller=tochuc&task=thanhlap");
		}
		
	}
	public function delquatrinh(){
		$user = JFactory::getUser();
		if(Core::_checkPerAction($user->id,'com_tochuc','tochuc','thanhlap') == false){
			JFactory::getApplication()->enqueueMessage('Bạn không có quyền truy cập','error');
			$this->setRedirect ( "index.php");
			return;
		}
		$quatrinh_id = JRequest::getInt('id',0);
// 		$model = JModelLegacy::getInstance('Tochuc','TochucModel');
		$model = Core::model('Tochuc/Tochuc');
		$model->delQuaTrinh($quatrinh_id);
		$this->setRedirect ( "index.php?option=com_tochuc&controller=tochuc&task=default");
	}
	public function deletedept(){
		$user = JFactory::getUser();
		if(Core::_checkPerAction($user->id,'com_tochuc','tochuc','thanhlap') == false){
			JFactory::getApplication()->enqueueMessage('Bạn không có quyền truy cập','error');
			$this->setRedirect ( "index.php");
			return;
		}
		$dept_id = JRequest::getInt('id',0);
// 		$model = JModelLegacy::getInstance('Tochuc','TochucModel');
		$model = Core::model('Tochuc/Tochuc');
		$model->deleteDept($dept_id);
		$this->setRedirect ( "index.php?option=com_tochuc&controller=tochuc&task=default");
	}
		public function savequatrinh(){
			$user = JFactory::getUser();
			if(Core::_checkPerAction($user->id,'com_tochuc','tochuc','thanhlap') == false){
				JFactory::getApplication()->enqueueMessage('Bạn không có quyền truy cập','error');
				$this->setRedirect ( "index.php");
				return;
			}
		JSession::checkToken() or die( 'Invalid Token' );
// 		$model = JModelLegacy::getInstance('Tochuc','TochucModel');\
		$model = Core::model('Tochuc/Tochuc');
		$formData = JRequest::get('post');
		//var_dump($formData);exit;						
		$formData['tieude'] = 'QĐ '.TochucHelper::getNameById($formData['cachthuc_id'], 'ins_dept_cachthuc').' ,Ngày '.$formData['quyetdinh_ngay'];
		$vanban_id = $model->saveVanban(array(
			'id'=>$formData['vanban_id'],
			'mahieu'=>$formData['quyetdinh_so'],
			'tieude'=>$formData['tieude'],				
			'ngaybanhanh'=>$formData['quyetdinh_ngay']				
		));
		$model->saveQuatrinh(array(
			'id'=>$formData['id'],
			'quyetdinh_so'=>$formData['quyetdinh_so'],
			'quyetdinh_ngay'=>$formData['quyetdinh_ngay'],
			'ghichu'=>$formData['ghichu'],
			'chitiet'=>$formData['chitiet'],			
			'name'=>$formData['name'],
			'hieuluc_ngay'=>TochucHelper::strDateVntoMySql($formData['hieuluc_ngay']),
			'dept_id'=>$formData['dept_id'],
			'cachthuc_id'=>$formData['cachthuc_id'],
			'ordering'=>99,
			'vanban_id'=>$vanban_id	
		));
		$model->saveTaptin($vanban_id,$formData['fileupload_id']);
		if($formData['is_changename']== 1){
			$model->changeName($formData['dept_id'],$formData['name']);
		}	
		$this->setRedirect ( "index.php?option=com_tochuc&controller=tochuc&task=default");
		
	}	
	public function download(){
// 		$model = JModelLegacy::getInstance('Tochuc','TochucModel');
		$model = Core::model('Tochuc/Tochuc');
		$id = JRequest::getInt('id',0);
		$row = $model->getFilebyIdVanban($id);
		if (!$row) {
			die('Lỗi không tìm thấy tập tin');
		}
		header('Content-type:application/octet-stream');
		header("Content-Disposition:attachment; filename =".$row['filename']);
		echo $row['content'];
		exit;
	}
	public function savesapnhap(){
// 		$model = JModelLegacy::getInstance('Tochuc','TochucModel');
		$model = Core::model('Tochuc/Tochuc');
		$formData = JRequest::get('post');
		// save qua trinh cho to chuc chinh
		$quatrinh_id = $model->saveQuatrinh(array(
				'quyetdinh_so'=>$formData['quyetdinh_so'],
				'quyetdinh_ngay'=>$formData['quyetdinh_ngay'],
				'ghichu'=>$formData['ghichu'],
				'chitiet'=>$formData['chitiet'],
				'hieuluc_ngay'=>$formData['hieuluc_ngay'],
				'name'=>$formData['name_chinh'],
				'dept_id'=>$formData['dept_chinh_id'],
				'cachthuc_id'=>2,// sap nhap
				'ngay_tao'=>date('Y-m-d H:i:s')
		));
		// luu vao log		
		$model->saveSapnhap(array(
				'dept_chinh_id'=>$formData['dept_chinh_id'],
				'dept_phu_id'=>$formData['dept_phu_id'],
				'quatrinh_id'=>$quatrinh_id,
				'dept_chinh_name'=>$formData['name_chinh'],
				'dept_phu_name'=>$formData['name_phu']
		));
		// change active
		$model->saveChangeActive($formData['dept_chinh_id'],1);

		// save qua trinh cho to chuc phu
		$model->saveQuatrinh(array(
				'quyetdinh_so'=>$formData['quyetdinh_so'],
				'quyetdinh_ngay'=>$formData['quyetdinh_ngay'],
				'ghichu'=>$formData['ghichu'],
				'chitiet'=>$formData['chitiet'],
				'hieuluc_ngay'=>$formData['hieuluc_ngay'],
				'name'=>$formData['name_phu'],
				'dept_id'=>$formData['dept_phu_id'],
				'cachthuc_id'=>2,// sap nhap
				'ngay_tao'=>date('Y-m-d H:i:s')
		));
		// change active dung hoat dong
		$model->saveChangeActive($formData['dept_phu_id'],0);
		var_dump($formData);
		exit;
	}
	public function savegiaobienche(){
		$user = JFactory::getUser();
		if(Core::_checkPerAction($user->id,'com_tochuc','tochuc','thanhlap') == false){
			JFactory::getApplication()->enqueueMessage('Bạn không có quyền truy cập','error');
			$this->setRedirect ( "index.php");
			return;
		}
		//$file = JRequest::getVar('file_upload', null, 'files', 'array');
		JSession::checkToken() or die( 'Invalid Token' );
		$model = Core::model('Tochuc/Tochuc');
		$formData = JRequest::get('post');
			$formData['tieude'] = 'QĐ '.TochucHelper::getNameById($formData['nghiepvu_id'], 'ins_nghiepvu_bienche','nghiepvubienche','id').' ,Ngày '.$formData['quyetdinh_ngay'];
			$vanban_id = $model->saveVanban(array(
					'id'=>$formData['vanban_id'],
					'mahieu'=>$formData['quyetdinh_so'],
					'tieude'=>$formData['tieude'],
					'ngaybanhanh'=>$formData['quyetdinh_ngay']
						
			));

			$quatrinh_id = $model->saveQuatrinhBienche(array(
					'id'=>$formData['id'],
					'quyetdinh_so'=>$formData['quyetdinh_so'],
					'quyetdinh_ngay'=>$formData['quyetdinh_ngay'],
					'ghichu'=>$formData['ghichu'],
					'hieuluc_ngay'=>TochucHelper::strDateVntoMySql($formData['hieuluc_ngay']),
					'dept_id'=>$formData['dept_id'],
					'nghiepvu_id'=>$formData['nghiepvu_id'],
					'ordering'=>99,
					'nam'=>$formData['nam'],
					'vanban_id'=>$vanban_id
			));
			Core::delete('ins_dept_quatrinh_bienche_chitiet', array('quatrinh_id = '=>$quatrinh_id));
			for ($i = 0; $i < count($formData['hinhthuc']); $i++) {				
				$model->saveQuatrinhBiencheChitiet($quatrinh_id,$formData['hinhthuc'][$i],(int)$formData['bienche'][$i]);
			}
		$model->saveTaptin($vanban_id,$formData['fileupload_id']);		
		$this->setRedirect ( "index.php?option=com_tochuc&controller=tochuc&task=default");	
	}
	public function delgiaobienche(){
		$user = JFactory::getUser();
		if(Core::_checkPerAction($user->id,'com_tochuc','tochuc','thanhlap') == false){
			JFactory::getApplication()->enqueueMessage('Bạn không có quyền truy cập','error');
			$this->setRedirect ( "index.php");
			return;
		}
		$quatrinh_id = JRequest::getInt('id',0);
		$model = Core::model('Tochuc/Tochuc');
		if ($model->delQuaTrinhGiaoBienche($quatrinh_id) == true) {
			JFactory::getApplication()->enqueueMessage('Xử lý mới thành công','success');
		}
		$this->setRedirect ( "index.php?option=com_tochuc&controller=tochuc&task=default");
	}
	public function checkTochucTrung(){
		$model = Core::model('Tochuc/Tochuc');
		$result = $model->checkTochucTrung();
		header('Content-type: application/json');
		echo json_encode($result);
		die;
	}
	public function orderup(){
		$id = JRequest::getInt('id',null);
		$table = Core::table('Tochuc/InsDept');
		if ($table->orderUp($id)) {
			$this->setRedirect("index.php?option=com_tochuc&controller=tochuc&task=default","Xử lý thành công!");
		}else{
			$this->setRedirect("index.php?option=com_tochuc&controller=tochuc&task=default","Xử lý không thành công!");
		}
	}
	public function orderdown(){
		$id = JRequest::getInt('id',null);
		$table = Core::table('Tochuc/InsDept');
		if ($table->orderDown($id)) {
			$this->setRedirect("index.php?option=com_tochuc&controller=tochuc&task=default","Xử lý thành công!");
		}else{
			$this->setRedirect("index.php?option=com_tochuc&controller=tochuc&task=default","Xử lý không thành công!");
		}		
	}
	// Phúc thêm
	public function savekhenthuong(){
		$user = JFactory::getUser();
		$model = Core::model('Tochuc/Tochuc');
		$post = JRequest::get('post');
		$formData= array();
		parse_str($post['frmKhenthuong'], $formData);
			$quatrinh_kt = $model->saveKhenthuong(array(
				'id_kt'=>$formData['id_kt'],
				'iddonvi_kt'=>$formData['dept_id'],
				'start_date_kt'=>TochucHelper::strDateVntoMySql($formData['start_date_kt']),
				'end_date_kt'=>TochucHelper::strDateVntoMySql($formData['end_date_kt']),
				'rew_code_kt'=>$formData['rew_code_kt'],
				'reason_kt'=>$formData['reason_kt'],
				'approv_date_kt'=>TochucHelper::strDateVntoMySql($formData['approv_date_kt']),
				'approv_number_kt'=>$formData['approv_number_kt'],
				'approv_unit_kt'=>$formData['approv_unit_kt'],
				'approv_per_kt'=>$formData['approv_per_kt'],
			));
			echo Core::PrintJson($quatrinh_kt);
			die;
	}
	public function savekyluat(){
		$model = Core::model('Tochuc/Tochuc');
		$post = JRequest::get('post');
		$formData= array();
		parse_str($post['frmkyluat'], $formData);
			$quatrinh_kl = $model->savekyluat(array(
				'id_kl'=>$formData['id_kl'],
				'iddonvi_kl'=>$formData['dept_id'],
				'start_date_kl'=>TochucHelper::strDateVntoMySql($formData['start_date_kl']),
				'end_date_kl'=>TochucHelper::strDateVntoMySql($formData['end_date_kl']),
				'rew_code_kl'=>$formData['rew_code_kl'],
				'reason_kl'=>$formData['reason_kl'],
				'approv_date_kl'=>TochucHelper::strDateVntoMySql($formData['approv_date_kl']),
				'approv_number_kl'=>$formData['approv_number_kl'],
				'approv_unit_kl'=>$formData['approv_unit_kl'],
				'approv_per_kl'=>$formData['approv_per_kl'],
			));
			echo Core::PrintJson($quatrinh_kl);
			die;
	}
	public function removekhenthuong(){
		$model = Core::model('Tochuc/Tochuc');
		$post = JRequest::get('post');
		$id = $post['id'];
		echo Core::PrintJson($model->removeKhenthuong($id));
		die;
	}
	public function removekyluat(){
		$model = Core::model('Tochuc/Tochuc');
		$post = JRequest::get('post');
		$id = $post['id'];
		echo Core::PrintJson($model->removeKyluat($id));
		die;
	}
	public function deletefilevanban(){
		$idFile = JRequest::getVar('idFile');
		$model = Core::model('Core/Attachment');
		if(!$model->deleteFileByMaso($idFile)){
			$result = '0';
		}else{
			$result = '1';
		}
		echo Core::PrintJson($result);
		die;
	}
}