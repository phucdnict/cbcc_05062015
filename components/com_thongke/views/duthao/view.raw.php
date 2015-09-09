<?php
/**
 * Author: Phucnh
 * Date created: Apr 25, 2015
 * Company: DNICT
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThongkeViewDuthao extends JViewLegacy {
	function display($tpl = null) {
	  $task = JRequest::getVar('task');
		  switch($task){
	  		case 'word_duthao_nltx':
	  			$this->_nltx();
	  			break;
	  		case 'word_duthao_nltth':
	  			$this->_nltth();
	  			break;
	  		case 'word_duthao_bnvnvc':
	  			$this->_bnvnvc();
	  			break;
	  		case 'word_duthao_dd':
	  			$this->_dd();
	  			break;
	  		case 'word_duthao_bn':
	  			$this->_bn();
	  			break;
	  		case 'word_duthao_cxnl':
	  			$this->_cxnl();
	  			break;
	  		case 'word_duthao_dttn':
	  			$this->_dttn();
	  			break;
	  		case 'word_duthao_ctnn':
	  			$this->_ctnn();
	  			break;
	  		case 'word_duthao_gqtv':
	  			$this->_gqtv();
	  			break;
	  		case 'word_duthao_kt':
	  			$this->_kt();
	  			break;
	  		case 'word_duthao_kl':
	  			$this->_kl();
	  			break;
	  	}
	  	parent::display($tpl);
	 }
	function _nltx(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		//  		$config_default = json_decode(Core::config('cbcc/template/default'));
		//  		$mauduthao			=	$config_default->mauduthao;
		$data = $model->duthao($idhoso, 'nltx');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
		header ("Content-Disposition: attachment; Filename=duthao_nangluongthuongxuyen" . date ( 'dmy' ) . ".doc" );
		$this->assignRef('data', $data);
		$this->setLayout('duthao_nltx');
	}
	function _nltth(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'nltth');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
		header ("Content-Disposition: attachment; Filename=duthao_nangluongtruocthoihan" . date ( 'dmy' ) . ".doc" );
		$this->assignRef('data', $data);
		$this->setLayout('duthao_nltth');
	}
	function _dd(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'dd');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
 		header ("Content-Disposition: attachment; Filename=duthao_dieudong" . date ( 'dmy' ) . ".doc" );
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_dd');
	}
	function _bn(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'bn');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
	 	header ("Content-Disposition: attachment; Filename=duthao_bonhiem" . date ( 'dmy' ) . ".doc" );
	 	$this->assignRef('data', $data);
	 	$this->setLayout('duthao_bn');
	}
	function _bnvnvc(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'bnvnvc');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
 		header ("Content-Disposition: attachment; Filename=duthao_bonhiemvaongachvienchuc" . date ( 'dmy' ) . ".doc" );
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_bnvnvc');
	}
	function _cxnl(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'cxnl');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
 		header ("Content-Disposition: attachment; Filename=duthao_chuyenxepngachluong" . date ( 'dmy' ) . ".doc" );
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_cxnl');
	}
	function _dttn(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'dttn');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
 		header ("Content-Disposition: attachment; Filename=duthao_daotaotrongnuoc" . date ( 'dmy' ) . ".doc" );
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_dttn');
	}
	function _ctnn(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'ctnn');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
 		header ("Content-Disposition: attachment; Filename=duthao_congtacnuocngoai" . date ( 'dmy' ) . ".doc" );
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_ctnn');
	}
	function _gqtv(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'gqtv');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
 		header ("Content-Disposition: attachment; Filename=duthao_thoiviec" . date ( 'dmy' ) . ".doc" );
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_gqtv');
	}
	function _kt(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'kt');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
 		header ("Content-Disposition: attachment; Filename=duthao_khenthuong" . date ( 'dmy' ) . ".doc" );
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_kt');
	}
	function _kl(){
		$idhoso = JRequest::getVar('idHoso');
		$model = Core::model('Thongke/Duthao');
		$data = $model->duthao($idhoso, 'kl');
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-type: application/vnd.ms-word");
 		header ("Content-Disposition: attachment; Filename=duthao_kyluat" . date ( 'dmy' ) . ".doc" );
 		$this->assignRef('data', $data);
 		$this->setLayout('duthao_kl');
	}
}
?>