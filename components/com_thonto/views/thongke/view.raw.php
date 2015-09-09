<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
class ThontosViewThongke extends JViewLegacy {
	function display($tpl = null) {
		$task = JRequest::getVar('task');
		switch($task){
// 			phụ lục 1
			case 'getPhuluc1':
				$this->setLayout('phuluc1');
				$this->getPhuluc1();
				break;
			case 'default_phuluc1':
				$this->setLayout('default_phuluc1');
				$this->_default_phuluc1();
				break;
// 			phụ lục 3
			case 'getPhuluc3':
				$this->setLayout('phuluc3');
				$this->getPhuluc3();
				break;
			case '_default_phuluc3':
				$this->setLayout('default_phuluc3');
				$this->_default_phuluc3();
				break;
// 			Phụ lục 4
			case '_default_phuluc4':
				$this->setLayout('default_phuluc4');
				$this->_default_phuluc4();
				break;
			case 'getPhuluc4':
				$this->setLayout('phuluc4');
				$this->getPhuluc4();
				break;
// 			Phụ lục 5
			case '_default_phuluc5':
				$this->setLayout('default_phuluc5');
				$this->_default_phuluc5();
				break;
			case 'getPhuluc5':
				$this->setLayout('phuluc5');
				$this->getPhuluc5();
				break;
// 			Phụ lục 6
			case '_default_phuluc6':
				$this->setLayout('default_phuluc6');
				$this->_default_phuluc6();
				break;
			case 'getPhuluc6':
				$this->setLayout('phuluc6');
				$this->getPhuluc6();
				break;
		}
		parent::display($tpl);
 	}
//  	phụ lục 1
 	private function getPhuluc1(){
 		$ids_donvi = JRequest::getVar('donvi_id');
 		$model_hoso = Core::model('Thonto/Thongke');
 		$ds_donvi = $model_hoso->getDonviBaocao($ids_donvi, '2,3');
 		$this->assignRef('ds_donvi', $ds_donvi);
 	}
 	public function _default_phuluc1(){
 		$document = JFactory::getDocument();
 		$model = Core::model('Thonto/Hoso');
 		$idUser = JFactory::getUser()->id;
 		$idRoot = '1';
 		if($idRoot == null){
 			$this->setLayout('hoso_404');
 		}else{
 			$id_donvi = $model->getInfoOfRootTree($idRoot);
 			$this->assignRef('id_donvi', $id_donvi);
 			$this->assignRef('idUser', $idUser);
 		}
 	}
//  	phụ lục 3 min qh
 	function getPhuluc3(){
 		$data = $_GET['id'];
 		$model = Core::model('Thonto/Thongke');
 		$this->assignRef('row', $model->getmau3($data));
 	}
 	public function _default_phuluc3(){
 		$document = JFactory::getDocument();
 		$model = Core::model('Thonto/Thongke');
 		$idUser = JFactory::getUser()->id;
 		$idRoot = 1;
 		if($idRoot == null){
 			$this->setLayout('hoso_404');
 		}else{
 			$root['root_id'] = $idRoot;
 			$tmp= $model->getThongtin(array('ten, kieu'),'thonto_tochuc',null,array('id='.$root['root_id']),null);
 			$root['root_name'] = $tmp[0]->ten;
 			$root['root_showlist'] = $tmp[0]->kieu;
 		}
 		$this->assignRef('root_info', $root);
 	}
// 	phụ lục 4 min px
 	function _default_phuluc4(){
 		$model = Core::model('Thonto/Thongke');
 		$idUser = JFactory::getUser()->id;
 		$idRoot = 1;
 		if($idRoot == null){
 			$this->setLayout('hoso_404');
 		}else{
 			$root['root_id'] = $idRoot;
 			$tmp= $model->getThongtin(array('ten, kieu'),'thonto_tochuc',null,array('id='.$root['root_id']),null);
 			$root['root_name'] = $tmp[0]->ten;
 			$root['root_showlist'] = $tmp[0]->kieu;
 		}
 		$this->assignRef('root_info', $root);
 	}
	function getPhuluc4(){
		$ids_donvi = $_GET['id'];
		$model = Core::model('Thonto/Thongke');
		$ds_donvi = $model->getDonviBaocao($ids_donvi,'2,3');
		$this->assignRef('ds_donvi', $ds_donvi);
	}
//  phụ lục 5 // min thôn tổ
 	public function _default_phuluc5(){
 		$document = JFactory::getDocument();
 		$model = Core::model('Thonto/Thongke');
 		$idUser = JFactory::getUser()->id;
 		$idRoot = 1;
 		if($idRoot == null){
 			$this->setLayout('hoso_404');
 		}else{
 			$root['root_id'] = $idRoot;
 			$tmp= $model->getThongtin(array('ten, kieu'),'thonto_tochuc',null,array('id='.$root['root_id']),null);
 			$root['root_name'] = $tmp[0]->ten;
 			$root['root_showlist'] = $tmp[0]->kieu;
 		}
 		$this->assignRef('root_info', $root);
 	}
 	function getPhuluc5(){
 		$ids_donvi = $_GET['id'];
 		$model = Core::model('Thonto/Thongke');
 		$ds_donvi = $model->getDonviBaocao($ids_donvi,'2,3,4,5');
 		$row_kiennghi = $model->getThongtin('id, ten', 'thonto_danhmuckiennghi', null, 'trangthai=1','sapxep asc');
 		$this->assignRef('row_kiennghi', $row_kiennghi);
 		$this->assignRef('ds_donvi', $ds_donvi);
 	}
 	// phụ lục 6 // min px
 	function _default_phuluc6(){
 		$model = Core::model('Thonto/Thongke');
 		$idUser = JFactory::getUser()->id;
 		$idRoot = 1;
 		if($idRoot == null){
 			$this->setLayout('hoso_404');
 		}else{
 			$root['root_id'] = $idRoot;
 			$tmp= $model->getThongtin(array('ten, kieu'),'thonto_tochuc',null,array('id='.$root['root_id']),null);
 			$root['root_name'] = $tmp[0]->ten;
 			$root['root_showlist'] = $tmp[0]->kieu;
 		}
 		$this->assignRef('root_info', $root);
 	}
 	function getPhuluc6(){
 		$ids_donvi = JRequest::getVar('id');
 		$model = Core::model('Thonto/Thongke');
 		$ds_donvi = $model->getDonviBaocao($ids_donvi,'2,3');
 		$row_noidunghop = $model->getThongtin('id, ten', 'thonto_danhmucnoidunghop', null, 'trangthai=1','sapxep asc');
 		$this->assignRef('row_noidunghop', $row_noidunghop);
 		$this->assignRef('ds_donvi', $ds_donvi);
 	}
}
?>