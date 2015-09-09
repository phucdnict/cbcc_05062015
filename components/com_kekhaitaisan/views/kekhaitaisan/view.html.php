<?php
defined('_JEXEC') or die('Restricted access');
class KekhaitaisanViewKekhaitaisan extends JViewLegacy{
    function display($tpl = null) {
    	$document = JFactory::getDocument();
        $task = JRequest::getVar('task');
        switch ($task){
        		default:
        			$this->setLayout('hoso_404');
        			break;
        		case "kekhai":
        			$this->setLayout('default');
        			$this->dungchung();
        			$this->checkPhanquyen();
        			$this->_getthongtinKekhai();
        			$this->getkekhaiid();
        			break;
//         		case "add":
//         			$this->setLayout('add');
//         			$this->dungchung();
//         			$this->checkPhanquyen();
//         			$this->_getEdit();
//         			break;
        }
        parent::display($tpl);
    }
    function dungchung(){
    	$document = JFactory::getDocument();
    	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/chosen.jquery.min.js');
    	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JUri::base(true).'/media/cbcc/js/jquery/jquery.blockUI.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.bootstrap.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/datatables.default.config.js');
    }
    public function checkPhanquyen(){
    	$idUser = JFactory::getUser()->id;
    	$idRoot = Core::_checkPerAction($idUser, 'com_kekhaitaisan', 'kekhaitaisan', 'kekhai', 'site');
    	$model			=	Core::model('Kekhaitaisan/Kekhaitaisan');
    	$hosoMapper		=	$model->getThongtin('*','core_user_hoso',null, 'user_id = '.$idUser, null);
    	if($idRoot == null){
    		$this->setLayout('hoso_404');
    	}
    	elseif((count($hosoMapper)==0)){
    		$this->setLayout('hoso_anhxa');
    	}
    }
    public function getkekhaiid(){
    	$model		=	Core::model('Kekhaitaisan/Kekhaitaisan');
    	$idHoso	=	$this->hosochinh_id;
    	$dot			=	$_REQUEST['dotkekhai'];
    	if ((int)$dot <1) $dot = $model->getLastDotkekhai($hosochinh_id);
    	if ($dot !=0){
    		$ch = $model->saveKekhai($idHoso, $dot);
    		$kekhai_id = $model->getKekhaiid($idHoso, $dot);
    		$this->assignRef('kekhai_id',$kekhai_id);
    	}
    }
    public function checkKekhai(){
    	$model						=	Core::model('Kekhaitaisan/Kekhaitaisan');
    	$doikekhai_last 		=	$model->getLastDotkekhai($hosochinh_id);
    	// nếu có đợt kê khai cũ thì cho zô, rồi gán this, qua view làm default,
    	// nếu chưa, lấy last
    	if ((int)$doikekhai_last>0) 
    		$this->assignRef('dotkekhai_id', $doikekhai_last);
    }
    public function _getthongtinKekhai(){
    	// lấy đợt và 
    	$model						=	Core::model('Kekhaitaisan/Kekhaitaisan');
    	$nguoikekhai            =	$model->getInfoNguoikekhai($model->getHosoidByJos(JFactory::getUser()->id));
    	$hosochinh_id 			= $nguoikekhai[0]->hosochinh_id;
    	
    	$this->assignRef('hosochinh_id', $hosochinh_id);
    	$this->assignRef('nguoikekhai', $nguoikekhai);
    }
//     public function _getEdit(){
//     		$model			=	Core::model('Kekhaitaisan/Kekhaitaisan');
//     		$taisan_cb		=	array();
// 	    	$taisan_kk		=	array();
// 	    	$taisan			=	$model->listTaisan(array('id', 'tenloaitaisan', 'type', 'parent_id'), array('status = 1'));
// 	    	$capcongtrinh           =	$model->listData('kkts_capcongtrinh', array('id', 'name'), array('status = 1') , $oder ='order by orders');
// 	    	$hokhau_city            =	$model->listData('city_code', array('code', 'name','code'), array('status = 1') , $oder ='order by name');
// 	    	$loainha		=	$model->listData('kkts_loainha', array('id', 'name'), array('status = 1') , $oder ='order by orders');
// 	    	$nguoikekhai            =	$model->getInfoNguoikekhai($model->getHosoidByJos(JFactory::getUser()->id));
// 	    	$dotkekhai		=	$model->listData('kkts_dotkekhai',array('id', 'name'), array('status = 1'));
// 	    	$hosochinh_id           =	$nguoikekhai[0]->hosochinh_id;
// 	        $vochong		=	$model->getNhanthan($hosochinh_id,'3,12,4'); //3: vợ, 12: vợ kế, 4: chồng
// 	        $concai			=	$model->getNhanthan($hosochinh_id,'8,19'); //8: con, 19: con nuôi
    	
//     	for ($i = 0; $i < count($taisan); $i++) {
//     		if ((int)$taisan[$i]['parent_id'] != 0) {
//     			$taisan_cb[(int)$taisan[$i]['parent_id']][$taisan[$i]['id']] = $taisan[$i]['tenloaitaisan'];
//     		}else {
//     			$taisan_kk[] = $taisan[$i];
//     		}
//     	}
//         $this->assignRef('hosochinh_id', $hosochinh_id);
//         $this->assignRef('vochong', $vochong);
//         $this->assignRef('concai', $concai);
//         $this->assignRef('dotkekhai', $dotkekhai);
//         $this->assignRef('nguoikekhai', $nguoikekhai);
//         $this->assignRef('loainha', $loainha);
//         $this->assignRef('hokhau_city', $hokhau_city);
//         $this->assignRef('capcongtrinh', $capcongtrinh);
//     	$this->assignRef('taisan_kk', $taisan_kk);
//     	$this->assignRef('taisan_cb', $taisan_cb);
//     }
}