<?php
/**
* @file: congtac.php
* @author: npbnguyen@gmail.com
* @date: 15-08-2015
* @company : http://dnict.vn
**/
class Thonto_Model_Congtac{
	/**
	 * Lấy danh sách thông tin chi tiết quá trình công tác của hồ sơ
	 *
	 * @param   integer  $idHoso  Mã hồ sơ.
	 *
	 * @return  null|array  Trả về danh sách thông tin chi tiết quá trình công tác của hồ sơ.
	 *
	 */
	public function getQuatrinhCongtac($idHoso){
		$db = JFactory::getDbo();
		$query = '	SELECT 	a.id,DATE_FORMAT(a.ngaybatdau,"%d/%m/%Y") AS ngaybatdau,
							DATE_FORMAT(a.ngayketthuc,"%d/%m/%Y") AS ngayketthuc,
							a.phuongxa_id,a.phuongxa,a.thonto_id,a.thonto,a.chucvu_id,a.chucvu
						FROM thonto_quatrinhcongtac AS a
						WHERE a.hosocanbo_id = '.$db->quote($idHoso).'
						ORDER BY a.ngaybatdau DESC';
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	/**
	 * Lấy danh sách thông tin chi tiết của quá trình công tác
	 *
	 * @param   integer  $id_quatrinh  Mã quá trình công tác.
	 *
	 * @return  null|array  Trả về danh sách thông tin chi tiết của quá trình công tác.
	 *
	 */
	public function getInfoCongtac($id_quatrinh){
		$db = JFactory::getDbo();
		$query = '	SELECT a.id,DATE_FORMAT(a.ngaybatdau,"%d/%m/%Y") AS ngaybatdau,
							DATE_FORMAT(a.ngayketthuc,"%d/%m/%Y") AS ngayketthuc,
							a.phuongxa_id,a.phuongxa,a.thonto_id,a.thonto,a.chucvu_id,a.chucvu
						FROM thonto_quatrinhcongtac AS a
						WHERE a.id = '.$db->quote($id_quatrinh);
		$db->setQuery($query);
		return $db->loadAssoc();
	}
}