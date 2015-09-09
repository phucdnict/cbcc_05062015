<?php
/**
* @file: Timkiem.php
* @author: npbnguyen@gmail.com
* @date: 19-08-2015
* @company : http://dnict.vn
**/
class Thonto_Model_Timkiem{
	public function getThonto($phuongxa_ids){
		$db = JFactory::getDbo();
		if(is_array($phuongxa_ids) && count($phuongxa_ids) > 0){
			foreach($phuongxa_ids AS $key=>$val){
				$query = 'SELECT lft,rgt
							FROM thonto_tochuc
							WHERE id = '.$db->quote($val);
				$db->setQuery($query);
				$node = $db->loadAssoc();
				
				$query = 'SELECT id
							FROM thonto_tochuc
							WHERE lft >= '.$db->quote($node['lft']).'
								AND rgt <= '.$db->quote($node['rgt']);
				$db->setQuery($query);
				$result[] = implode(',', $db->loadColumn());
			}
			$query = 'SELECT id,ten
						FROM thonto_tochuc
						WHERE id IN ('.implode(',', $result).')
							AND kieu IN (4,5)
							AND trangthai_id = 1
						ORDER BY lft';
			$db->setQuery($query);
			return $db->loadAssocList();
		}else{
			return array();
		}
	}
	public function getDataTimkiem($data){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('a.id,a.hoten,DATE_FORMAT(a.ngaysinh, "%d/%m/%Y") AS ngaysinh,IF(a.gioitinh = "Nam", "Nam", "Nữ") AS gioitinh,
						a.dienthoailienhe,a.email,b.s_name AS chuyenmon_trinhdo,IF(a.dadaotaonghiepvu = "1","Có","Không") AS dadaotaonghiepvu,
						a.congtac_donvi,a.congtac_chucvu,d.ten AS nghenghiephientai,DATE_FORMAT(a.ngayvaodang, "%d/%m/%Y") AS ngayvaodang,
						DATE_FORMAT(a.ngaychinhthuc, "%d/%m/%Y") AS ngaychinhthuc,c.ten AS loaibaohiemyte')
			->from($db->quoteName('thonto_hosocanbo','a'))
			->join('LEFT', 'cla_sca_code AS b ON a.chuyenmon_trinhdo_code = b.code AND b.tosc_code = 2')
			->join('LEFT', 'thonto_loaibaohiemyte AS c ON a.loaibaohiemyte_id = c.id')
			->join('LEFT', 'thonto_nghenghiephientai AS d ON a.nghenghiephientai = d.id');
		
		if(isset($data['hoten']) && $data['hoten'] != ''){
			$where[] = 'a.hoten LIKE '.$db->quote('%'.$data['hoten'].'%');
		}
		if(isset($data['congtac_chucvu_id']) && is_array($data['congtac_chucvu_id'])){
			$where[] = 'a.congtac_chucvu_id IN ('.implode(',', $data['congtac_chucvu_id']).')';
		}
		if(isset($data['phuongxa_id']) && $data['phuongxa_id'] != ''){
			$where[] = 'a.congtac_donvi_id IN (SELECT id FROM thonto_tochuc WHERE donvi_id IN ('.implode(',', $data['phuongxa_id']).'))';
		}
		if(isset($data['congtac_donvi_id']) && is_array($data['congtac_donvi_id'])){
			$where[] = 'a.congtac_donvi_id IN ('.implode(',', $data['congtac_donvi_id']).')';
		}
		if(isset($data['nghenghiephientai']) && is_array($data['nghenghiephientai'])){
			$where[] = 'a.nghenghiephientai IN ('.implode(',', $data['nghenghiephientai']).')';
		}
		
		if(count($where) > 0){
			$query->where($where);
		}
		$db->setQuery($query);
		return $db->loadAssocList();
	}
}