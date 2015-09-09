<?php
/**
 * Author: Phucnh
 * Date created: May 12, 2015
 * Company: DNICT
 */
class Zxbaocao_Model_Tuan{
	/**
	 * combobox với một danh mục đơn giản
	 * @param string $table
	 * @param string $field
	 * @param string $where
	 * @param string $order
	 * @param string $text
	 * @param string $code
	 * @param string $name
	 * @param string $selected
	 * @param string $idname
	 * @param string $class
	 * @param string $attrArray
	 */
	public function getCbo($table,$field,$where=null,$order,$text,$code,$name,$selected=null,$idname=null,$class=null,$attrArray=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array($field))
		->from($table);
		if($where != null || $where != "")
			$query->where($where);
		$query->order($order);
		$db->setQuery($query);
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value','text' => $text));
		for($i=0;$i<count($tmp);$i++){
			$attr=array();
			if(isset($attrArray) && is_array($attrArray))
			foreach ($attrArray as $k=>$v){
				$attr+=array($k=>$tmp[$i]->$v);
			}
			if (!isset($attr) && !is_array($attr))
				array_push($data, array('value' => $tmp[$i]->$code,'text' => $tmp[$i]->$name));
			else {
				array_push($data, array('value' => $tmp[$i]->$code,'text' => $tmp[$i]->$name,'attr'=>$attr));
			}
		}
		$options = array(
				'id' => $idname,
				'list.attr' => array(
						'class'=>$class,
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$selected
		);
		return $result = JHtmlSelect::genericlist($data,$idname,$options);
	}
	/**
	 * Hàm lưu quá trình kỷ luật
	 * @param unknown $formData
	 * @return boolean
	 */
	public function savetuan($formData){
		$db =  JFactory::getDbo();
		$query = $db->getQuery(true);
		if (isset($formData['hai'])) $hai = 1;
		if (isset($formData['ba'])) $ba = 1;
		if (isset($formData['tu'])) $tu = 1;
		if (isset($formData['nam'])) $nam = 1;
		if (isset($formData['sau'])) $sau = 1;
		if (isset($formData['bay'])) $bay = 1;
		$fields = array(
			$db->quoteName('user_id').'='.$db->quote($formData['user_id']),
			$db->quoteName('congviec').'='.$db->quote($formData['congviec']),
			$db->quoteName('maduan').'='.$db->quote($formData['maduan']),
			$db->quoteName('tenduan').'='.$db->quote($formData['tenduan']),
			$db->quoteName('batdau').'='.$db->quote($this->strDateVntoMySql($formData['batdau'])),
			$db->quoteName('ketthuc').'='.$db->quote($this->strDateVntoMySql($formData['ketthuc'])),
			$db->quoteName('hoanthanh').'='.$db->quote($formData['hoanthanh']),
			$db->quoteName('ykiendexuat').'='.$db->quote($formData['ykiendexuat']),
			$db->quoteName('hai').'='.$db->quote($hai),
			$db->quoteName('ba').'='.$db->quote($ba),
			$db->quoteName('tu').'='.$db->quote($tu),
			$db->quoteName('nam').'='.$db->quote($nam),
			$db->quoteName('sau').'='.$db->quote($sau),
			$db->quoteName('bay').'='.$db->quote($bay),
		);
		if(isset($formData['trangthai'])){ 
			array_push($fields, $db->quoteName('trangthai').'= 1'); 
		}else{ 
			array_push($fields, $db->quoteName('trangthai').'= 0');
		}
		if(isset($formData['dophuctap'])){ 
			array_push($fields, $db->quoteName('dophuctap').'= 1'); 
		}else{ 
			array_push($fields, $db->quoteName('dophuctap').'= 0');
		}
		if (isset($formData['id']) && $formData['id']>0){
			$conditions = array(
					$db->quoteName('id').'='.$db->quote($formData['id'])
			);
			$query->update($db->quoteName('zxbaocao'))->set($fields)->where($conditions);
		}
		else{
			$query->insert($db->quoteName('zxbaocao'));
			$query->set($fields);
		}
// 		echo $query;exit;
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		} else {
			return true;
		}
	}
	/**
	 * Xóa quá trình báo cáo
	 * @param int $id
	 * @return boolean
	 */
	public function delquatrinh($id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array(
				$db->quoteName('id').' IN ('.$id.')'
		);
		$query->delete($db->quoteName('zxbaocao'));
		$query->where($conditions);
		$db->setQuery($query);
// 		echo $query;die;
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		} else {
			return true;
		}
	}
	/**
	 * Hàm lấy thông tin từ 1 table, có thể join thêm bảng và điều kiện, trả về 1 list đối tượng
	 * @param array|string $field
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
// 		echo $query;die;
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 *
	 * @param string $dateVN
	 */
	static public function strDateVntoMySql($dateVN){
		if (empty($dateVN)) {
			return '';
		}
		$dateVN = explode('/', $dateVN);
		return $dateVN[2].'-'.$dateVN[1].'-'.$dateVN[0];
	}
}