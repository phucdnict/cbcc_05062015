<?php
/**
 * Author: Phucnh
 * Date created: Aug 13, 2015
 * Company: DNICT
 */
class Thonto_Model_Chibo{
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
	public function savechibo($arrData){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('donvi_id').'='.$db->quote($arrData['donvi_id']),
				$db->quoteName('ten').'='.$db->quote($arrData['ten']),
				$db->quoteName('soluongthanhvien').'='.$db->quote($arrData['soluongthanhvien']),
				$db->quoteName('namthanhlap').'='.$db->quote($arrData['namthanhlap']),
				$db->quoteName('ghichu').'='.$db->quote($arrData['ghichu']),
				$db->quoteName('trangthai').'=1',
		);
		if ((isset($arrData['id'])) && ($arrData['id']>0)){
			$conditions = array(
					$db->quoteName('id').'='.$db->quote($arrData['id'])
			);
			$query->update($db->quoteName('thonto_chibo'))->set($fields)->where($conditions);
		}else{
			$query->insert($db->quoteName('thonto_chibo'));
			$query->set($fields);
		}
		$db->setQuery($query);
		if (!$db->execute()) return false;
		else return true;
	}
	public function xoachibo($id){
		$db = JFactory::getDbo();
		$query=$db->getQuery(true);
		$query = 'delete from thonto_chibo  where id ='.(int)$id;
		$db->setQuery($query);
		return $db->query();
	}
}