<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class KekhaitaisanViewKekhaitaisan extends JViewLegacy
{
	function display($tpl = null)
	{
		$task = JRequest::getVar('task');
		$task = ($task == null)?'default':strtoupper($task);
		switch($task){
			case "FRMNHANTHAN":
				$this->setLayout('frmnhanthan');
				$this->frmnhanthan();
				break;
			case "FRMNHA":
				$this->setLayout('frmnha');
				$this->frmnha();
				break;
			case "FRMDAT":
				$this->setLayout('frmdat');
				$this->frmdat();
				break;
			case "FRMKHAC":
				$this->setLayout('frmkhac');
				$this->frmkhac();
				break;
			case "FRMTAISAN":
				$this->setLayout('frmtaisan');
				$this->frmtaisan();
				break;
			case "GETTAISAN":
				$this->gettaisan();
				break;
			case "NHANTHAN":
				$this->setLayout('nhanthan');
				break;
			case "TAISAN":
				$this->setLayout('taisan');
				$this->gettaisan();
				break;
			case "GETNHANTHAN":
				$this->getnhanthan();
				break;
			case "XOANHANTHAN":
				$this->xoanhanthan();
				break;
			case "XOATAISAN":
				$this->xoataisan();
				break;
			case "GETDIST":
				$this->getDist();
				break;
			case "GETCOMM":
				$this->getComm();
				break;
		}		
		parent::display($tpl);
	}
	/**
	 * Lấy thông tin tài sản
	 */
	public function frmtaisan(){
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$taisan_id = $_GET['id'];
		if((int)$taisan_id>0){
			$row 		=	$model->getThongtin('*', 'kkts_kekhai_chitiet', null, 'id = '.$taisan_id, null);
			$values= $row[0];
			$p_id = $model->gettaisanparent($values->taisan_id);
			if($p_id ==0) $ts_id = $values->taisan_id; else $ts_id = $p_id;
		}
		$data = $model->getCbo('kkts_taisan', 'id, tenloaitaisan, type','status=1 and parent_id = 0', 'orders asc', '','--Chọn--','id', 'tenloaitaisan', $ts_id, 'loaitaisan_id',' chosen',array('type'=>'type'));
		$this->assignRef('taisan_id', $data);
		$this->assignRef('row', $values);
	}
	/**
	 * thông tin tài sản nhà
	 */
	public function frmnha(){
		$model = Core::model('Kekhaitaisan/Kekhaitaisan');
		$taisan_id = $_GET['id'];
		if((int)$taisan_id>0){
			$row 		=	$model->getThongtin('*', 'kkts_kekhai_chitiet', null, 'id = '.$taisan_id, null);
			$values= $row[0];
		}
		$this->assignRef('row', $values);
		$cbonha = $model->getCbo('kkts_taisan', 'id, tenloaitaisan, type','status=1 and parent_id !=0 and type= 1', 'orders asc', '','--Chọn--','id', 'tenloaitaisan', $values->taisan_id, 'taisan_id',' chosen',array('type'=>'type'));
		$cboloainha = $model->getCbo('kkts_loainha', 'id, name','status=1', 'orders asc', '','--Chọn--','id', 'name', $values->loainha_id, 'loainha_id',' chosen');
		$cbocapcongtrinh = $model->getCbo('kkts_capcongtrinh', 'id, name','status=1', 'orders asc', '','--Chọn--','id', 'name', $values->capcongtrinh_id, 'capcongtrinh_id',' chosen');
		$this->assignRef('cbonha', $cbonha);
		$this->assignRef('cboloainha', $cboloainha);
		$this->assignRef('cbocapcongtrinh', $cbocapcongtrinh);
	}
	/**
	 * thông tin tài sản đất
	 */
	public function frmdat(){
		$model = Core::model('Kekhaitaisan/Kekhaitaisan');
		$taisan_id = $_GET['id'];
		if((int)$taisan_id>0){
			$row 		=	$model->getThongtin('*', 'kkts_kekhai_chitiet', null, 'id = '.$taisan_id, null);
			$values= $row[0];
		}
		$cbodat = $model->getCbo('kkts_taisan', 'id, tenloaitaisan, type','status=1 and parent_id !=0 and type= 2', 'orders asc', '','--Chọn--','id', 'tenloaitaisan', $values->taisan_id, 'taisan_id',' chosen',array('type'=>'type'));
		$this->assignRef('row', $values);
		$this->assignRef('cbodat', $cbodat);
	}
	/**
	 * thông tin tài sản khác
	 */
	public function frmkhac(){
		$model = Core::model('Kekhaitaisan/Kekhaitaisan');
		$loaitaisan_id = $_GET['loaitaisan_id']; //id của loại tài sản trong danh mục
		$taisan_id = $_GET['id']; //id của tài sản kê khai
		if((int)$taisan_id>0){
			$row 		=	$model->getThongtin('*', 'kkts_kekhai_chitiet', null, 'id = '.$taisan_id, null);
			$values= $row[0];
		}
		$this->assignRef('row', $values);
		
		if((int)$loaitaisan_id>0) $check = $model->getThongtin('id', 'kkts_taisan',null, ' parent_id ='.$loaitaisan_id, null);
		// check xem có con hay không
		if (count($check)>0){
			$cbotaisankhac  = $model->getCbo('kkts_taisan', 'id, tenloaitaisan, type','status=1 and parent_id ='.$loaitaisan_id.' and type= 0', 'orders asc', '','--Chọn--','id', 'tenloaitaisan', $values->taisan_id, 'taisan_id',' chosen',array('type'=>'type'));
			$this->assignRef('cbotaisankhac', $cbotaisankhac);
		}
		else {
			$ar	=  $model->getThongtin('id, tenloaitaisan', 'kkts_taisan',null, ' id ='.$loaitaisan_id, null);
			$cbotaisankhac = $ar[0]->tenloaitaisan;
			$this->assignRef('cbotaisankhac', $cbotaisankhac);
		}
	}
	/**
	 * Xóa thông tin nhân thân
	 */
	public function xoanhanthan(){
		$model = Core::model('Kekhaitaisan/Kekhaitaisan');
		$post  = $_POST['iddel'];
		Core::PrintJson($model->xoanhanthan($post));
		die;
	}
	/**
	 * Đưa thông tin vào form nhân thân
	 */
	public  function frmnhanthan(){
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
		if (isset($_GET['nhanthan_id'])) {
			$nhanthan = $model->getNhanthanchitiet($_GET['nhanthan_id']);
			$this->assignRef('nhanthan', $nhanthan);
		}
		$this->assignRef('relative_code_id', $model->getCboRelation($nhanthan[0]->relative_code_id , 'relative_code_id'));
	}
	/**
	 *  Lấy thông tin nhân thân
	 */
	public  function getnhanthan(){
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$kekhai_id = $_POST['kekhai_id'];
		Core::PrintJson($model->getNhanthan($kekhai_id));
		die;
	}
	/**
	 *  Lấy thông tin tai san
	 */
	public  function gettaisan(){
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$kekhai_id = JRequest::getInt('kekhai_id',0);
		$taisancha = $model->getThongtin('id, tenloaitaisan, type', 'kkts_taisan', null, 'status = 1 AND parent_id=0','orders asc');
		$this->assignRef('taisancha', $taisancha);
		$this->assignRef('taisan', $model->gettaisan($kekhai_id));
	}
	/**
	 * Xóa tài sản
	 */
	public function xoaTaisan(){
		$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$post  = $_POST['iddel'];
		Core::PrintJson($model->xoataisan($post));
		die;
	}
	/**
	 * Hiển thị combobox chọn quận huyện
	 */
	public function getDist(){
		$model	=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$hokhau_tinhthanh 	=	$_POST['hokhau_tinhthanh'];
		$quanhuyen = $model->getCbo('dist_code', 'code, name','status=1 and cadc_code = '.$hokhau_tinhthanh, 'name asc', '','--Chọn quận huyện--','code', 'name', '', 'hokhau_quanhuyen',' chosen','');
		Core::PrintJson($quanhuyen);
		die;
	}
	/**
	 * Hiển thị combobox chọn phường xã
	 */
	public function getComm(){
		$model	=	Core::model('Kekhaitaisan/Kekhaitaisan');
		$hokhau_quanhuyen 	=	$_POST['hokhau_quanhuyen'];
		$phuongxa = $model->getCbo('comm_code', 'code, name','status=1 and dc_code = '.$hokhau_quanhuyen, 'name asc', '','--Chọn phường xã--','code', 'name', '', 'hokhau_phuongxa',' chosen','');
		Core::PrintJson($phuongxa);
		die;
	}
}