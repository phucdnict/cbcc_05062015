<?php
/**
* @file: hoso.php
* @author: npbnguyen@gmail.com
* @date: 12-08-2015
* @company : http://dnict.vn
**/
class Thonto_Model_Hoso{
	/**
	 * Lấy thông tin tổ chức được phân quyền sử dụng cây hồ sơ
	 * 
	 * @param Integer $idRoot	Mã tổ chức được phân quyền
	 * 
	 * @return Trả về thông tin tổ chức được phân quyền sử dụng cây hồ sơ.
	 */
	public function getInfoOfRootTree($idRoot){
		$db = JFactory::getDbo();
		$query = '	SELECT a.id AS rootId,a.ten AS rootName,a.kieu AS rootType,a.donvi_id AS rootDonvihanhchinh
						FROM thonto_tochuc AS a
						WHERE a.id = '.$db->quote($idRoot);
		$db->setQuery($query);
		return $db->loadAssoc();
	}
	/**
	 * Lấy thông tin các tổ chức theo mã tổ chức cha
	 * 
	 * @param Integer $id_parent	Mã tổ chức cha
	 * 
	 * @return Trả về thông tin các tổ chức theo mã tổ chức cha.
	 */
	public function treeView($id_parent,$option = array()){
		$db = JFactory::getDbo();
		$query = '	SELECT a.id,a.parent_id,a.kieu AS type,a.ten AS name,a.level,a.lft,a.rgt,a.trangthai_id AS active,a.donvi_id
						FROM thonto_tochuc AS a
						WHERE a.trangthai_id = 1 AND a.parent_id = '.$db->quote($id_parent).'
						ORDER BY a.lft';
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$arrTypes = array('file','folder','root');
		for ($i=0,$n=count($rows);$i<$n;$i++){
			$types = '';
			$result[] = array(
					"attr" =>	 array(
									"id" => "node_".$rows[$i]['id'],
									"rel" => $arrTypes[$rows[$i]['type']],
									"showlist" => $rows[$i]['type'],
									"donvihanhchinh" => $rows[$i]['donvi_id']
								),
					"data" => $rows[$i]['name'],
					"state" => ((int)$rows[$i]['rgt'] - (int)$rows[$i]['left'] > 1) ? "closed" : ""
			);
		}
		return json_encode($result);
	}
	public function getInfoOfHoso($idHoso){
		$db = JFactory::getDbo();
		$query = '	SELECT 	a.id,a.hoten,DATE_FORMAT(a.ngaysinh, "%d/%m/%Y") AS ngaysinh,a.gioitinh,a.dienthoailienhe,a.email,a.danhdaudangvien,
							DATE_FORMAT(a.ngayvaodang, "%d/%m/%Y") AS ngayvaodang,DATE_FORMAT(a.ngaychinhthuc, "%d/%m/%Y") AS ngaychinhthuc,
							a.chuyenmon_trinhdo_code,a.chuyenmon_trinhdo_mucdo,a.chuyenmon_chuyennganh_id,a.chuyenmon_chuyennganh,a.chuyenmon_truong_id,
							a.chuyenmon_truong,a.chuyenmon_namtotnghiep,a.chuyenmon_hinhthucdaotao_id,a.chuyenmon_loaitotnghiep_id,a.chuyenmon_nuocdaotao,
							a.nghenghiephientai,a.loaibaohiemyte_id,a.dadaotaonghiepvu,DATE_FORMAT(a.congtac_ngaybatdau, "%d/%m/%Y") AS congtac_ngaybatdau,
							a.congtac_phuongxa_id,a.congtac_phuongxa,a.congtac_thonto_id,a.congtac_thonto,a.congtac_chucvu_id,a.congtac_chucvu,
							a.congtac_chucvu_kiemnhiem_id,a.congtac_chucvu_kiemnhiem,a.hosochinh_id,a.trangthai,a.chucdanhchibo_id
						FROM thonto_hosocanbo AS a
						WHERE a.id = '.$db->quote($idHoso);
		$db->setQuery($query);
		return $db->loadAssoc();
	}
	public function themmoiHoso($formData){
		$db = JFactory::getDbo();
		$data = array(
			'hoten'=>$formData['hoten'],
			'ngaysinh'=>$formData['ngaysinh'],
			'gioitinh'=>$formData['gioitinh'],
			'dienthoailienhe'=>$formData['dienthoailienhe'],
			'email'=>$formData['email'],
			'danhdaudangvien'=>$formData['danhdaudangvien'],
			'ngayvaodang'=>$formData['ngayvaodang'],
			'ngaychinhthuc'=>$formData['ngaychinhthuc'],
			'chuyenmon_trinhdo_code'=>$formData['chuyenmon_trinhdo_code'],
			'chuyenmon_trinhdo_mucdo'=>$formData['chuyenmon_trinhdo_mucdo'],
			'chuyenmon_chuyennganh_id'=>$formData['chuyenmon_chuyennganh_id'],
			'chuyenmon_chuyennganh'=>$formData['chuyenmon_chuyennganh'],
			'chuyenmon_truong_id'=>$formData['chuyenmon_truong_id'],
			'chuyenmon_truong'=>$formData['chuyenmon_truong'],
			'chuyenmon_namtotnghiep'=>$formData['chuyenmon_namtotnghiep'],
			'chuyenmon_hinhthucdaotao_id'=>$formData['chuyenmon_hinhthucdaotao_id'],
			'chuyenmon_loaitotnghiep_id'=>$formData['chuyenmon_loaitotnghiep_id'],
			'chuyenmon_nuocdaotao'=>$formData['chuyenmon_nuocdaotao'],
			'nghenghiephientai'=>$formData['nghenghiephientai'],
			'loaibaohiemyte_id'=>$formData['loaibaohiemyte_id'],
			'dadaotaonghiepvu'=>$formData['dadaotaonghiepvu'],
			'congtac_ngaybatdau'=>$formData['congtac_ngaybatdau'],
			'congtac_phuongxa_id'=>$formData['congtac_phuongxa_id'],
			'congtac_phuongxa'=>$formData['congtac_phuongxa'],
			'congtac_thonto_id'=>$formData['congtac_thonto_id'],
			'congtac_thonto'=>$formData['congtac_thonto'],
			'congtac_chucvu_id'=>$formData['congtac_chucvu_id'],
			'congtac_chucvu'=>$formData['congtac_chucvu'],
			'congtac_chucvu_kiemnhiem_id'=>$formData['congtac_chucvu_kiemnhiem_id'],
			'congtac_chucvu_kiemnhiem'=>$formData['congtac_chucvu_kiemnhiem'],
			'chucdanhchibo_id'=>$formData['chucdanhchibo_id'],
			'hosochinh_id'=>$formData['hosochinh_id'],
			'trangthai'=>$formData['trangthai']
		);
		
		foreach ($data as $key => $value) {
			if ($value == '' || $value == null) {
				unset($data[$key]);
			}else{
				$data_insert_key[] = $key;
				if($key == 'ngaysinh' || $key == 'ngayvaodang' || $key == 'ngaychinhthuc' || $key == 'congtac_ngaybatdau'){
					$data_insert_val[] = 'STR_TO_DATE("'.$value.'","%d/%m/%Y")';
				}else{
					$data_insert_val[] = $db->quote($value);
				}
			}
		}
				
		$query = $db->getQuery(true);
		$query->insert($db->quoteName('thonto_hosocanbo'))->columns($data_insert_key)->values(implode(',', $data_insert_val));
		$db->setQuery($query);
		if(!$db->query()){
			return false;
		}
		
		$id_hosocanbo = $db->insertid();
		
		$data_congtac = array(
			'ngaybatdau'=>$formData['congtac_ngaybatdau'],
			'phuongxa_id'=>$formData['congtac_phuongxa_id'],
			'phuongxa'=>$formData['congtac_phuongxa'],
			'thonto_id'=>$formData['congtac_thonto_id'],
			'thonto'=>$formData['congtac_thonto'],
			'chucvu_id'=>$formData['congtac_chucvu_id'],
			'chucvu'=>$formData['congtac_chucvu'],
			'hosocanbo_id'=>$id_hosocanbo,
		);
		
		foreach ($data_congtac as $key_congtac => $value_congtac) {
			if ($value_congtac == '' || $value_congtac == null) {
				unset($data_congtac[$key]);
			}else{
				$data_insert_key_congtac[] = $key_congtac;
				if($key_congtac == 'ngaybatdau'){
					$data_insert_val_congtac[] = 'STR_TO_DATE("'.$value_congtac.'","%d/%m/%Y")';
				}else{
					$data_insert_val_congtac[] = $db->quote($value_congtac);
				}
			}
		}
				
		$query = $db->getQuery(true);
		$query->insert($db->quoteName('thonto_quatrinhcongtac'))->columns($data_insert_key_congtac)->values(implode(',', $data_insert_val_congtac));
		$db->setQuery($query);
		if(!$db->query()){
			return false;
		}
		
		return true;
	}
	public function capnhatHoso($formData){
		$db = JFactory::getDbo();
		$data = array(
			'hoten'=>$formData['hoten'],
			'ngaysinh'=>$formData['ngaysinh'],
			'gioitinh'=>$formData['gioitinh'],
			'dienthoailienhe'=>$formData['dienthoailienhe'],
			'email'=>$formData['email'],
			'danhdaudangvien'=>$formData['danhdaudangvien'],
			'ngayvaodang'=>$formData['ngayvaodang'],
			'ngaychinhthuc'=>$formData['ngaychinhthuc'],
			'chuyenmon_trinhdo_code'=>$formData['chuyenmon_trinhdo_code'],
			'chuyenmon_trinhdo_mucdo'=>$formData['chuyenmon_trinhdo_mucdo'],
			'chuyenmon_chuyennganh_id'=>$formData['chuyenmon_chuyennganh_id'],
			'chuyenmon_chuyennganh'=>$formData['chuyenmon_chuyennganh'],
			'chuyenmon_truong_id'=>$formData['chuyenmon_truong_id'],
			'chuyenmon_truong'=>$formData['chuyenmon_truong'],
			'chuyenmon_namtotnghiep'=>$formData['chuyenmon_namtotnghiep'],
			'chuyenmon_hinhthucdaotao_id'=>$formData['chuyenmon_hinhthucdaotao_id'],
			'chuyenmon_loaitotnghiep_id'=>$formData['chuyenmon_loaitotnghiep_id'],
			'chuyenmon_nuocdaotao'=>$formData['chuyenmon_nuocdaotao'],
			'nghenghiephientai'=>$formData['nghenghiephientai'],
			'loaibaohiemyte_id'=>$formData['loaibaohiemyte_id'],
			'dadaotaonghiepvu'=>$formData['dadaotaonghiepvu'],
			'congtac_ngaybatdau'=>$formData['congtac_ngaybatdau'],
			'hosochinh_id'=>$formData['hosochinh_id']
		);
		
		foreach ($data as $key => $value) {
			if ($value == '' || $value == null) {
				$data_update[] = $key." = NULL";
			}else{
				$data_insert_key[] = $key;
				if($key == 'ngaysinh' || $key == 'ngayvaodang' || $key == 'ngaychinhthuc'){
					$data_update[] = $key." = STR_TO_DATE('".$value."','%d/%m/%Y')";
				}else{
					$data_update[] = $key." = ".$db->quote($value);
				}
			}
		}

		$query = $db->getQuery(true);
		$query->update($db->quoteName('thonto_hosocanbo'));
		$query->set(implode(',', $data_update));
		$query->where(array($db->quoteName('id').'='.$db->quote($formData['idHoso'])));
		$db->setQuery($query);
		if(!$db->query()){
			return false;
		}
		return true;
	}
	public function xoaHoso($formData){
		$db = JFactory::getDbo();
		$idsRemove = implode(',', $formData['idHoso']);
		$query = '	UPDATE thonto_hosocanbo SET trangthai = 0 WHERE id IN ('.$idsRemove.')';
		$db->setQuery($query);
		if(!$db->query()){
			return false;
		}
		return true;
	}
	public function updateHientaiCongtac($idHoso){
		$db = JFactory::getDbo();
		$query = 'UPDATE thonto_hosocanbo AS a
						INNER JOIN (SELECT *
										FROM thonto_quatrinhcongtac
										WHERE hosocanbo_id = '.$db->quote($idHoso).'
										ORDER BY ngaybatdau DESC
										LIMIT 1) AS b ON a.id = b.hosocanbo_id
						SET a.congtac_ngaybatdau = b.ngaybatdau,
							a.congtac_phuongxa_id = b.phuongxa_id,
							a.congtac_phuongxa = b.phuongxa,
							a.congtac_thonto_id = b.thonto_id,
							a.congtac_thonto = b.thonto,
							a.congtac_chucvu_id = b.chucvu_id,
							a.congtac_chucvu = b.chucvu
						WHERE a.id = '.$db->quote($idHoso);
		$db->setQuery($query);
		if(!$db->query()){
			return false;
		}
	}
	/**
	 * Lưu quá trình công tác
	 * 
	 * @return TRUE|FALSE
	 */
	public function saveCongtac($formData){
		$db = JFactory::getDbo();
		
		$data = array(
				'id'=>$formData['id_quatrinh'],
				'hosocanbo_id'=>$formData['hosocanbo_id'],
				'ngaybatdau'=>$formData['ngaybatdau'],
				'ngayketthuc'=>$formData['ngayketthuc'],
				'phuongxa_id'=>$formData['phuongxa_id'],
				'phuongxa'=>$formData['phuongxa'],
				'thonto_id'=>$formData['thonto_id'],
				'thonto'=>$formData['thonto'],
				'chucvu_id'=>$formData['chucvu_id'],
				'chucvu'=>$formData['chucvu']
		);
		
		foreach ($data as $key => $value) {
			if ($value == '' || $value == null) {
				unset($data[$key]);
			}else{
				$data_insert_key[] = $key;
				if($key == 'ngaybatdau' || $key == 'ngayketthuc'){
					$data_insert_val[] = "STR_TO_DATE('".$value."','%d/%m/%Y')";
				}else{
					$data_insert_val[] = $db->quote($value);
				}
			}
		}
		
		if((int)$data['id'] > 0){
			$conditions = array('id = '.$db->quote($data['id']));
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('thonto_quatrinhcongtac'))->where($conditions);
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
			
			$query = $db->getQuery(true);
			$query->insert($db->quoteName('thonto_quatrinhcongtac'))->columns($data_insert_key)->values(implode(',', $data_insert_val));
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
		}else{
			$query = $db->getQuery(true);
			$query->insert($db->quoteName('thonto_quatrinhcongtac'))->columns($data_insert_key)->values(implode(',', $data_insert_val));
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
		}
		$this->updateHientaiCongtac($formData['hosocanbo_id']);
		return true;
	}
	/**
	 * Lưu quá trình khen thưởng
	 * 
	 * @return TRUE|FALSE
	 */
	public function saveKhenthuong($formData){
		$db = JFactory::getDbo();
		
		$data = array(
				'id'=>$formData['id_quatrinh'],
				'hosocanbo_id'=>$formData['hosocanbo_id'],
				'hinhthuc_id'=>$formData['hinhthuc_id'],
				'hinhthuc'=>$formData['hinhthuc'],
				'ngayquyetdinh'=>$formData['ngayquyetdinh'],
				'soquyetdinh'=>$formData['soquyetdinh'],
				'coquanquyetdinh'=>$formData['coquanquyetdinh'],
				'nguoiky'=>$formData['nguoiky']
		);
		
		foreach ($data as $key => $value) {
			if ($value == '' || $value == null) {
				unset($data[$key]);
			}else{
				$data_insert_key[] = $key;
				if($key == 'ngayquyetdinh'){
					$data_insert_val[] = "STR_TO_DATE('".$value."','%d/%m/%Y')";
				}else{
					$data_insert_val[] = $db->quote($value);
				}
			}
		}
		
		if((int)$data['id'] > 0){
			$conditions = array('id = '.$db->quote($data['id']));
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('thonto_quatrinhkhenthuong'))->where($conditions);
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
			
			$query = $db->getQuery(true);
			$query->insert($db->quoteName('thonto_quatrinhkhenthuong'))->columns($data_insert_key)->values(implode(',', $data_insert_val));
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
		}else{
			$query = $db->getQuery(true);
			$query->insert($db->quoteName('thonto_quatrinhkhenthuong'))->columns($data_insert_key)->values(implode(',', $data_insert_val));
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
		}
		return true;
	}
	/**
	 * Lưu quá trình kỷ luật
	 * 
	 * @return TRUE|FALSE
	 */
	public function saveKyluat($formData){
		$db = JFactory::getDbo();
		
		$data = array(
				'id'=>$formData['id_quatrinh'],
				'hosocanbo_id'=>$formData['hosocanbo_id'],
				'hinhthuc_id'=>$formData['hinhthuc_id'],
				'hinhthuc'=>$formData['hinhthuc'],
				'ngayquyetdinh'=>$formData['ngayquyetdinh'],
				'soquyetdinh'=>$formData['soquyetdinh'],
				'coquanquyetdinh'=>$formData['coquanquyetdinh'],
				'nguoiky'=>$formData['nguoiky']
		);
		
		foreach ($data as $key => $value) {
			if ($value == '' || $value == null) {
				unset($data[$key]);
			}else{
				$data_insert_key[] = $key;
				if($key == 'ngayquyetdinh'){
					$data_insert_val[] = "STR_TO_DATE('".$value."','%d/%m/%Y')";
				}else{
					$data_insert_val[] = $db->quote($value);
				}
			}
		}
		
		if((int)$data['id'] > 0){
			$conditions = array('id = '.$db->quote($data['id']));
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('thonto_quatrinhkyluat'))->where($conditions);
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
			
			$query = $db->getQuery(true);
			$query->insert($db->quoteName('thonto_quatrinhkyluat'))->columns($data_insert_key)->values(implode(',', $data_insert_val));
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
		}else{
			$query = $db->getQuery(true);
			$query->insert($db->quoteName('thonto_quatrinhkyluat'))->columns($data_insert_key)->values(implode(',', $data_insert_val));
			$db->setQuery($query);
			if(!$db->query()){
				return false;
			}
		}
		return true;
	}
	public function hasChucvu($donvi_id, $chucvu_id){
		$db = JFactory::getDbo();
		$query = 'SELECT IF(COUNT(*) > 0,1,0)
					FROM thonto_hosocanbo
					WHERE congtac_donvi_id = '.$db->quote($donvi_id).'
						AND congtac_chucvu_id = '.$db->quote($chucvu_id);
		$db->setQuery($query);
		return $db->loadResult();
	}
	public function getThonto($donvi_id){
		$db = JFactory::getDbo();
		$query = 'SELECT lft,rgt
					FROM thonto_tochuc
					WHERE id = '.$db->quote($donvi_id);
		$db->setQuery($query);
		$node = $db->loadAssoc();
		
		$query = 'SELECT id,ten,kieu
					FROM thonto_tochuc
					WHERE trangthai_id = 1
						AND kieu IN (4,5)
						AND lft >= '.$db->quote($node['lft']).'
						AND rgt <= '.$db->quote($node['rgt']);
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	public function getChucvu($loaihinhtochuc_id){
		$db = JFactory::getDbo();
		$query = 'SELECT id,ten, sothangbonhiem
					FROM thonto_chucvu
					WHERE trangthai = 1
						AND loaihinhtochuc_id = '.$db->quote($loaihinhtochuc_id);
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	/**
	 * Xóa dữ liệu các quá trình theo mã quá trình và mã hồ sơ
	 * 
	 * @param String $typeRemove	Loại quá trình (quatrinhcongtac,quatrinhkhenthuong,quatrinhkyluat)
	 * @param Integer $idsQuatrinh	Mã quá trình
	 * @param Integer $idHoso		Mã hồ sơ
	 * 
	 * @return TRUE|FALSE
	 */
	public function removeDataOfTable($typeRemove, $idsQuatrinh, $idHoso = null){
		$db = JFactory::getDbo();
		$table = array(
			'quatrinhcongtac' => 'quatrinhcongtac',
			'quatrinhkhenthuong' 	=> 'quatrinhkhenthuong',
			'quatrinhkyluat'		=> 'quatrinhkyluat'
		);
		$query = $db->getQuery(true);
		$query->delete($table[$typeRemove])
			->where('id IN ('.$idsQuatrinh.')');
		$db->setQuery($query);
		if(!$db->query()){
			return false;
		}
		if($idHoso != null){
			if($typeRemove == 'congtac'){
				$this->updateHientaiCongtac($idHoso);
			}else if($typeRemove == 'quatrinhkhenthuong'){
				$this->updateHientaiKhenthuong($idHoso);
			}else if($typeRemove == 'quatrinhkyluat'){
				$this->updateHientaiKyluat($idHoso);
			}
		}
		return true;
	}
}