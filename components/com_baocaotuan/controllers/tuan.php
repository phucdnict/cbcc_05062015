<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 * Báo cáo tuần
 */
class BaocaotuanControllerTuan extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		$document   =& JFactory::getDocument();
		$viewName   =	JRequest::getVar( 'view', 'tuan');
		JRequest::setVar('controller','tuan');
		$viewLayout = JRequest::getVar( 'layout', 'default');
		$viewType   = $document->getType();
		$view =& $this->getView( $viewName, $viewType);
		$view->setLayout($viewLayout);
		$view->display();
		$task = JRequest::getVar('task');
		switch($task){
			case 'savequatrinh':
				$this->savequatrinh();
				break;
			case 'delquatrinh':
				$this->delquatrinh();
				break;
			case 'savelamthemgio':
				$this->savelamthemgio();
				break;
			case 'dellamthemgio':
				$this->dellamthemgio();
				break;
		}
	}
	function uploadtuan(){
		$model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
		$arrKq	=	$model->uploadtuan();
		if (count($arrKq)>0) {
			echo 	'<br/>
	 				<span style="color:blue">Import thành công.</span>
	 				<br/>
	 				<span style="color:red">Có lỗi xảy ra, vui lòng liên hệ quản trị viên:
	 				<br/>';
			foreach ($arrKq as $val)
				echo '- '.$val.'<br/>';
			echo '</span>';
		}
		else echo "<br/><span style='color:blue'>Import thành công, thông tin đã được lưu</span>";
	
	}
	function savequatrinh(){
		 $formData = JRequest::get('post');
		$values = array();
		parse_str($formData['form_baocaotuan'], $values);
		$model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
		if($model->savetuan($values)){
			Core::PrintJson(true);
		}
		else Core::PrintJson(false);
		die;
	}
	function savelamthemgio(){
		 $formData = JRequest::get('post');
		$values = array();
		parse_str($formData['form_lamthemgio'], $values);
		$model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
		$lamthemgio = $model->strDateVntoMySql($values['ngaylamthem']);
		$thoigianlamthem = $model->getThongtin('sum(thoigian) as thoigian', 'zxlamthemgio', null, ' DATE_FORMAT(ngaylamthem,"%Y") = date_format("'.$lamthemgio.'", "%Y")' );
		if ($thoigianlamthem[0]->thoigian >200)
			Core::PrintJson(1);
		else if($values['ngaylamthem']+$thoigianlamthem[0]->thoigian >200)
			Core::PrintJson(2);
		else{
			if($model->savelamthemgio($values)){
				Core::PrintJson(true);
			}
			else Core::PrintJson(false);
		}
		die;
	}
	function delquatrinh(){
		 $formData = $_POST['iddel'];
		 $model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
		$str ='0';
		for($i=0; $i<count($formData);$i++){
			$str .= ','.$formData[$i];
		}
		$kq= $model->delquatrinh($str);
		Core::PrintJson($kq);
		die;
	}
	function dellamthemgio(){
		 $formData = $_POST['iddel'];
		 $model = JModelLegacy::getInstance('Tuan','BaocaotuanModel');
		$str ='0';
		for($i=0; $i<count($formData);$i++){
			$str .= ','.$formData[$i];
		}
		$kq= $model->dellamthemgio($str);
		Core::PrintJson($kq);
		die;
	}
}
?>