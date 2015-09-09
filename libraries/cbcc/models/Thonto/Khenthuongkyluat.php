<?php
/**
* @file: khenthuongkyluat.php
* @author: npbnguyen@gmail.com
* @date: 15-08-2015
* @company : http://dnict.vn
**/
class Thonto_Model_Khenthuongkyluat{
	/**
	 * Lấy danh sách quá trình khen thưởng theo mã hồ sơ và mã điều động
	 *
	 * @param   integer  $idHoso  		Mã hồ sơ.
	 *
	 * @return  null|array  Trả về danh sách quá trình khen thưởng.
	 *
	 */
	public function Quatrinhkhenthuong($idHoso){
		$db = JFactory::getDbo();
		$query = '	SELECT 	id,hosocanbo_id,hinhthuc_id,hinhthuc,DATE_FORMAT(a.ngayquyetdinh,"%d/%m/%Y") AS ngayquyetdinh,
							soquyetdinh,coquanquyetdinh,nguoiky
						FROM thonto_quatrinhkhenthuong AS a
						WHERE a.hosocanbo_id = '.$db->quote($idHoso).'
						ORDER BY a.ngayquyetdinh DESC';
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	/**
	 * Lấy thông tin quá trình khen thưởng
	 *
	 * @param   integer $id_quatrinh  Mã quá trình khen thưởng.
	 *
	 * @return  null|array  Trả về thông tin quá trình khen thưởng.
	 *
	 */
	public function getInfoKhenthuong($id_quatrinh){
		$db = JFactory::getDbo();
		$query = '	SELECT 	id,hosocanbo_id,hinhthuc_id,hinhthuc,DATE_FORMAT(a.ngayquyetdinh,"%d/%m/%Y") AS ngayquyetdinh,
							soquyetdinh,coquanquyetdinh,nguoiky
						FROM thonto_quatrinhkhenthuong AS a
						WHERE id = '.$db->quote($id_quatrinh);
		$db->setQuery($query);
		return $db->loadAssoc();
	}
	/**
	 * Lấy danh sách quá trình kỷ luật theo mã hồ sơ và mã điều động
	 *
	 * @param   integer  $idHoso  		Mã hồ sơ.
	 * @param   integer  $idQuatrinh 	Mã quá trình.
	 * @param   String   $typeQuatrinh 	Loại quá trình (điều động - dieudong, các trạng thái khác - trangthai).
	 *
	 * @return  null|array  Trả về danh sách quá trình kỷ luật.
	 *
	 */
	public function Quatrinhkyluat($idHoso){
		$db = JFactory::getDbo();
		$query = '	SELECT 	a.id,a.hosocanbo_id,a.hinhthuc_id,a.hinhthuc,DATE_FORMAT(a.ngayquyetdinh,"%d/%m/%Y") AS ngayquyetdinh,
							a.soquyetdinh,a.coquanquyetdinh,a.nguoiky
						FROM thonto_quatrinhkyluat AS a 
						WHERE a.hosocanbo_id = '.$db->quote($idHoso).'
						ORDER BY a.ngayquyetdinh DESC';
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	/**
	 * Lấy thông tin quá trình kỷ luật
	 *
	 * @param   integer $id_quatrinh  Mã quá trình kỷ luật.
	 *
	 * @return  null|array  Trả về thông tin quá trình kỷ luật.
	 *
	 */
	public function getInfoKyluat($id_quatrinh){
		$db = JFactory::getDbo();
		$query = '	SELECT 	a.id,a.hosocanbo_id,a.hinhthuc_id,a.hinhthuc,DATE_FORMAT(a.ngayquyetdinh,"%d/%m/%Y") AS ngayquyetdinh,
							a.soquyetdinh,a.coquanquyetdinh,a.nguoiky
						FROM thonto_quatrinhkyluat AS a
						WHERE id = '.$db->quote($id_quatrinh);
		$db->setQuery($query);
		return $db->loadAssoc();
	}
}