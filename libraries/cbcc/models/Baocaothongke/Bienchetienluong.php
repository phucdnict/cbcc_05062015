<?php
class Baocaothongke_Model_Bienchetienluong extends JModelList
{
 	var $selectModel; //Model cho select
	var $leftModel; //Model cho left
	var $whereModel; //Model cho where
	var $shareModel; //Model cho where
	
	var $_i = 0; //So thu tu de chen vao mang listDv
	var $_ids; //Danh sach don vi gui tu bien $_POST cua form
	var $listDv; //Danh sach don vi, array[$i]['attr']
	var $maxDepth = 0; //Muc do mo cua danh sach
	var $loaibc; //Cac loai bien che phai bao cao
	var $displayLoaiBC; //Co hien thi bien che hay khong
	var $whereQuery = ''; //Co hien thi bien che hay khong
	var $hdk;
	
	function __construct(){
		parent::__construct();

		$this->selectModel	=	Core::model('Baocaothongke/Select');
		$this->leftModel	=	Core::model('Baocaothongke/Left');
		$this->whereModel	=	Core::model('Baocaothongke/Where');
		$this->shareModel	=	Core::model('Baocaothongke/Share');
		
		$this->_ids[] 		=	JRequest::getVar('ids_bienchetienluong',0,'post','array');	
		$this->maxDepth 	=	JRequest::getVar('exp_lev_bienchetienluong');
		
		$this->displayLoaiBC	= JRequest::getVar('bienchetienluong_hienthiloaibc');	
	}
	
	
	function getRootTree(){
		$me			=	& JFactory::getUser();
		$user		=	JFactory::getUser();
		$id_user	=	$user->id;
		
		$data['component']	=	JRequest::getCmd('option', 'com_baocaochatluong');
		$data['controller']	=	JRequest::getCmd('controller', 'bienchetienluong');
		$data['location']	=	'site';
		$data['tasks']		=	JRequest::getCmd('tasks');
		
		$root_id	=	Core::getManageUnit($id_user,$data['component'], $data['controller'],$data['tasks'],$data['location'] );
		$arr_data	=	$this->selectModel->getIdNameInsdept($root_id);

		JRequest::setVar('root_id', $arr_data[0]);
		JRequest::setVar('root_name', $arr_data[1]);
	}
	

	function getPhongbyDonvi($donvi_id){
		$db		=	JFactory::getDbo();
		$query	= 'select id, name from ins_dept
					where parent_id = '.$db->quote($donvi_id).'
					ORDER BY lft';
		
		$db->setQuery($query);
		$data	=	$db->loadAssoc();
		return $data;
	}
	function getIdNameInsdept($ins_dept){
		$id		=	(int)$ins_dept;
		$db		=	JFactory::getDbo();
		$query = 'select id, name from ins_dept
				where id = '.(int)$ins_dept;
		$db->setQuery($query);
		return $db->loadRow();
	}
	function getDanhsachhoso($iddv){
		$luongcoban	= 	Core::config('cbcc/luong/luongcoban');
		$bhxh		=	Core::config('cbcc/luong/phantrambhxh') / 100;
		$bhyt		=	Core::config('cbcc/luong/phantrambhyt') / 100;
		$db	=	JFactory::getDbo();
		$query	=	'select hosochinh_id, hoten,	congtac_chucvu,congtac_donvi_id, congtac_donvi,congtac_phong_id, congtac_phong, luong_mangach,
			luong_heso,	congtac_chucvu_heso	,luong_vuotkhung, luong_phucap_trachnhiem, hs.e_code , ht.name, ht.s_name
			from hosochinh_quatrinhhientai as hsht
			INNER JOIN hosochinh as hs ON hs.id = hsht.hosochinh_id
			INNER JOIN bc_hinhthuc as ht ON ht.id = hsht.bienche_hinhthuc_id
			WHERE hsht.hoso_trangthai = "00" and congtac_donvi_id = '.$db->quote($iddv)
		.' ORDER BY congtac_phong_id ASC, congtac_chucvutuongduong ASC';
// 		-- ,	luong_phucap_trachnhiem;
		$db->setQuery($query);
		$data	=	$db->loadAssocList();
// 		var_dump($data); exit;
		for ($i = 0; $i < count($data); $i++) {
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]					=	$data[$i];
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['tongheso']		=	$data[$i]['luong_heso'] + $data[$i]['congtac_chucvu_heso'] + $data[$i]['luong_phucap_trachnhiem'] + $data[$i]['luong_vuotkhung'];
			
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['luong_tt']		=	$data[$i]['luong_heso'] * $luongcoban;
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['chucvu_tt']		=	$data[$i]['congtac_chucvu_heso'] * $luongcoban;
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['trachnhiem_tt']	=	$data[$i]['luong_phucap_trachnhiem'] * $luongcoban;
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['vuotkhung_tt']	=	$data[$i]['luong_vuotkhung'] * $luongcoban * $data[$i]['luong_heso'] / 100;
			
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['tongthanhtien']	=	($data[$i]['luong_heso'] + $data[$i]['congtac_chucvu_heso'] + $data[$i]['luong_phucap_trachnhiem'])*$luongcoban + $ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['vuotkhung_tt'];
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['bhxh']			=	$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['tongthanhtien'] * $bhxh;
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['bhyt']			=	$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['tongthanhtien'] * $bhyt;
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['cong_truluong']	=	$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['bhxh'] + $ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['bhyt'];
			$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['tongtienluongnhan']	=	$ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['tongthanhtien'] - $ar_data[$data[$i]['congtac_phong_id']]['data'][$data[$i]['hosochinh_id']]['cong_truluong'];
			
			$ar_data[$data[$i]['congtac_phong_id']]['name']	=	$data[$i]['congtac_phong'];
		}
// 		var_dump($ar_data); exit;
		return $ar_data;
	}
	
}
 

