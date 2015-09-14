<?php
class Baocaothongke_Model_Thongkecanbocongchucpx extends JModelList
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
// 		$this->whereModel	=	Core::model('Baocaothongke/Where');
		$this->shareModel	=	Core::model('Baocaothongke/Share');
		
		$this->_ids[] 		=	JRequest::getVar('ids_bienchetienluong',0,'post','array');	
		$this->maxDepth 	=	JRequest::getVar('exp_lev_bienchetienluong');
		
		$this->displayLoaiBC	= JRequest::getVar('bienchetienluong_hienthiloaibc');	
	}
	function getRootTree(){
		$me			=	& JFactory::getUser();
		$user		=	JFactory::getUser();
		$id_user	=	$user->id;
	
		$data['component']	=	JRequest::getCmd('option', 'com_baocaothongke');
		$data['controller']	=	JRequest::getCmd('controller', 'thongkecanbocongchucpx');
		$data['location']	=	'site';
		$data['tasks']		=	JRequest::getCmd('tasks','default');
		$root_id	=	Core::getManageUnit($id_user,$data['component'], $data['controller'],$data['tasks'],$data['location'] );
		$arr_data	=	$this->selectModel->getId_config_donvi_bc($root_id, 'canbopx');
		JRequest::setVar('root_id', $arr_data[0]);
		JRequest::setVar('root_name', $arr_data[1]);
	}
	
	// Phúc thêm
	function _getList_Chucdanh($report_group_code){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('relation_name as name', 'relation_id'))->from('config_bc')->where('report_group_code = '.$db->quote($report_group_code));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	function getAllhosobyDonvi($donvi_id, $chucdanh){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('distinct(ht.hosochinh_id),ht.hoten, ht.congtac_chucvu_id')
				->from('hosochinh_quatrinhhientai ht')
				->join('inner','(
			SELECT node.ins_dept FROM config_donvi_bc AS node, config_donvi_bc AS parent
			 WHERE node.lft BETWEEN parent.lft AND parent.rgt AND parent.id IN ('.$donvi_id.')
			) AS dvbc ON ht.congtac_donvi_id = dvbc.ins_dept ');
		$query
		->where('ht.hoso_trangthai="00"')
		->where('ht.congtac_chucvu_id IN (-99, '.$chucdanh.')');
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	function getThongtincanhan($hosochinh_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('ht.hosochinh_id,ht.hoten,
				if(danhdaunamsinh=0, DATE_FORMAT(ngaysinh,"%d/%m/%Y"), DATE_FORMAT(ngaysinh,"%Y")) as ngaysinh,
				hsc.sex as gioitinh, ht.congtac_chucvu_id, ht.congtac_chucvu,
				ht.dang_danhdaudangvien, dantoc.name as dantoc, tongiao.name as tongiao,
				if(hsc.elec_prov=1 ,1, 0) as elec_prov, 
				if(hsc.elec_dist=1 ,1, 0) as elec_dist, 
				if(hsc.elec_comm=1 ,1, 0) as elec_comm, 
				if(TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) <= 30,1,NULL) duoi30,
		(if(TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE())> 30 and TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) <= 40,1,NULL)) tu30den40,
		(if(TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) > 40 and TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) <= 50,1,NULL)) tu40den50,
		(if(TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) > 50 and TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) <= 50,1,NULL)) tu50den60,
		(if(TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) > 50 and TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) <= 55,1,NULL)) tu50den55,
		(if(TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) > 55 and TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) <= 60,1,NULL)) tu55den60,
		if(TIMESTAMPDIFF(YEAR, ht.ngaysinh, CURDATE()) > 60,1,NULL) tren60')
		->from('hosochinh_quatrinhhientai ht')
		->join('inner','hosochinh hsc ON hsc.id = ht.hosochinh_id')
		->join('inner','nat_code dantoc ON dantoc.id = hsc.nat_code')
		->join('left','rel_code tongiao ON tongiao.id = hsc.rcs_code')
		->where('ht.hoso_trangthai="00"')
		->where('ht.hosochinh_id = '.$hosochinh_id);
		$db->setQuery($query);
		return $db->loadObject();
	}
	/**
	 * Lấy ngày bắt đầu BHXH
	 * @param unknown $hosochinh_id
	 * @return Ambigous <mixed, NULL>
	 */
	function getNgaybatdauBHXH($hosochinh_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('DATE_FORMAT(min(ngaybatdau),"%d/%m/%Y")')
		->from('quatrinhbaohiemxahoi')
		->where('hosochinh_id = '.$hosochinh_id);
		$db->setQuery($query);
		return $db->loadResult();
	}
	function trinhdovanhoa($hosochinh_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('
				count(if(trinhdo_code = -1, 1, NULL)) as tieuhoc,
				count(if(trinhdo_code = 10, 1, NULL)) as thcs,
				count(if(trinhdo_code = 22, 1, NULL)) as phothong
				')
		->from('quatrinhdaotaophothong')
		->where('hosochinh_id = '.$hosochinh_id);
		$db->setQuery($query);
		return $db->loadObject();
	}
	function trinhdochuyenmon($hosochinh_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('
				count(if(cla.step <=2,1,NULL)) cm_thacsi ,
				count(if(cla.step =3,1,NULL)) cm_daihoc,
				count(if(cla.step =4,1,NULL)) cm_caodang,
				count(if(cla.step =5,1,NULL)) cm_trungcap,
				count(if(cla.step =6,1,NULL)) cm_socap
				')
		->from('quatrinhdaotaochuyenmon qt')
		->join('left','cla_sca_code cla ON cla.code = qt.trinhdo_code and cla.tosc_code=qt.tosc_code_dt')
		->where('qt.hosochinh_id = '.$hosochinh_id)->where('	cla.tosc_code = 2');
		$db->setQuery($query);
		return $db->loadObject();
	}
	function trinhdonghiepvu($hosochinh_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('
				count(if(llct.step =5,1,NULL)) llct_socap,
				count(if(llct.step =4,1,NULL)) llct_trungcap,
				count(if(llct.step <=3,1,NULL)) llct_caocap,
				count(if(qlnn.step =2,1,NULL)) qlnn_cv,
				count(if(qlnn.step <=1,1,NULL)) qlnn_cvc,
				count(if(th.step >=6,1,NULL)) th_chungchi,
				count(if(th.step =5 or th.step =4,1,NULL)) th_trungcap,
				count(if(th.step =3,1,NULL)) th_caodang,
				count(if(th.step <=2,1,NULL)) th_daihoc,
				count(if(nn.step >=5,1,NULL)) nn_chungchi,
				count(if(nn.step =4,1,NULL)) nn_trungcap,
				count(if(nn.step =3,1,NULL)) nn_caodang,
				count(if(nn.step <=2,1,NULL)) nn_daihoc,
				count(if(qpan.step <=5,1,NULL)) quocphonganninh
				')
		->from('quatrinhboiduongnghiepvu qt')
		->join('left','cla_sca_code llct ON llct.code = qt.trinhdo_code and llct.tosc_code=qt.tosc_code_dt and llct.tosc_code = 3')
		->join('left','cla_sca_code qlnn ON qlnn.code = qt.trinhdo_code and qlnn.tosc_code=qt.tosc_code_dt and qlnn.tosc_code = 5')
		->join('left','cla_sca_code th ON th.code = qt.trinhdo_code and th.tosc_code=qt.tosc_code_dt and th.tosc_code = 7')
		->join('left','cla_sca_code nn ON nn.code = qt.trinhdo_code and nn.tosc_code=qt.tosc_code_dt and nn.tosc_code = 6')
		->join('left','cla_sca_code qpan ON qpan.code = qt.trinhdo_code and qpan.tosc_code=qt.tosc_code_dt and qpan.tosc_code = 17')
		->where('qt.hosochinh_id = '.$hosochinh_id);
		$db->setQuery($query);
		return $db->loadObject();
	}
	/**
	 * Hàm lấy thông tin từ 1 table, có thể join thêm bảng và điều kiện, trả về 1 list đối tượng
	 * @param array $field
	 * @param string $table
	 * @param array $arrJoin array(key => value)
	 * @param array $where array(where1, where2)
	 * @param string $order
	 * @return objectlist
	 */
	function getThongtin($field, $table, $arrJoin=null, $where=null, $order=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($field)
		->from($table);
		if (count($arrJoin)>0)
		foreach ($arrJoin as $key=>$val){
			$query->join($key, $val);
		}
		for($i=0;$i<count($where);$i++)
		if ($where[$i]!='')
		$query->where($where);
		if($order!=null)$query->order($order);
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}
 

