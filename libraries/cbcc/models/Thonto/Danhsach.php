<?php
/**
* @file: danhsach.php
* @author: npbnguyen@gmail.com
* @date: 13-08-2015
* @company : http://dnict.vn
**/
class Thonto_Model_Danhsach{
	/**
	 * Lấy danh sách trích ngang của đơn vị hoặc phòng ban theo trạng thái hồ sơ
	 *
	 * @param   integer  $id_donvi  Mã đơn vị hoặc phòng ban.
	 * @param   integer  $status  Trạng thái hồ sơ.
	 * 
	 * @return  null|array JSON  Trả về danh sách trích ngang của đơn vị hoặc phòng ban theo trạng thái hồ sơ.
	 *
	 */
	public function getDanhsachTrichngang($id_donvi){
		$db = JFactory::getDbo();
		$db->sql("SET character_set_client=utf8");
		$db->sql("SET character_set_connection=utf8");
		$db->sql("SET character_set_results=utf8");
		
		$query = '	SELECT lft,rgt
						FROM thonto_tochuc
						WHERE id = '.$db->quote($id_donvi);
		$db->setQuery($query);
		$row = $db->loadAssoc();
		
		$columns = array(
				array('db' => 'a.id',																	'dt' => 0),
				array('db' => 'a.hoten',																'dt' => 1),
				array('db' => 'a.ngaysinh',																'dt' => 2),
				array('db' => 'IF(a.gioitinh = "Nam", "Nam", "Nữ")',		'alias' => 'gioitinh',		'dt' => 3),
				array('db' => 'a.dienthoailienhe',														'dt' => 4),
				array('db' => 'a.email',																'dt' => 5),
				array('db' => 'b.s_name',																'dt' => 6),
				array('db' => 'IF(a.dadaotaonghiepvu = "1","Có","Không")',	'alias' => 'nghiepvu',		'dt' => 7),
				array('db' => 'a.congtac_thonto',														'dt' => 8),
				array('db' => 'a.congtac_chucvu',														'dt' => 9),
				array('db' => 'd.ten',										'alias' => 'nghenghiep',	'dt' => 10),
				array('db' => 'a.ngayvaodang',															'dt' => 11),
				array('db' => 'a.ngaychinhthuc',														'dt' => 12),
				array('db' => 'c.ten',																	'dt' => 13)
		);
		$table = 'thonto_hosocanbo AS a';
		$primaryKey = 'a.id';
		$join = '	LEFT JOIN cla_sca_code AS b ON a.chuyenmon_trinhdo_code = b.code AND b.tosc_code = 2
					LEFT JOIN thonto_loaibaohiemyte AS c ON a.loaibaohiemyte_id = c.id
					LEFT JOIN thonto_nghenghiephientai AS d ON a.nghenghiephientai = d.id
					INNER JOIN (SELECT id 
							FROM thonto_tochuc 
							WHERE kieu IN (4,5)
								AND trangthai_id = 1 
								AND lft >= '.$db->quote($row['lft']).'
								AND rgt <= '.$db->quote($row['rgt']).') AS e ON a.congtac_thonto_id = e.id';
		$where = 'a.trangthai = 1 
					GROUP BY a.id';
		$datatables = Core::model('Core/Datatables');
		return $datatables->simple( $_POST, $table, $primaryKey, $columns ,$join, $where);
	}
}