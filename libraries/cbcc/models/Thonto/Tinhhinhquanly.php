<?php
class Thonto_Model_Tinhhinhquanly{
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
	public function luutinhhinhquanly($arrData){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('thonto_id').'='.$db->quote($arrData['thonto_id']),
				$db->quoteName('dotbaocao_id').'='.$db->quote($arrData['dotbaocao_id']),
				$db->quoteName('lapsotheodoihoatdong').'='.$db->quote($arrData['lapsotheodoihoatdong']),
				$db->quoteName('thanhphan_soluong1').'='.$db->quote($arrData['thanhphan_soluong1']),
				$db->quoteName('thanhphan_soluong2').'='.$db->quote($arrData['thanhphan_soluong2']),
				$db->quoteName('thanhphan_soluong3').'='.$db->quote($arrData['thanhphan_soluong3']),
				$db->quoteName('soluongvang').'='.$db->quote($arrData['soluongvang']),
				$db->quoteName('kiennghi_soluong').'='.$db->quote($arrData['kiennghi_soluong']),
				$db->quoteName('kiennghi_dagiaiquyet').'='.$db->quote($arrData['kiennghi_dagiaiquyet']),
		);
		if ((isset($arrData['id'])) && ($arrData['id']>0)){
			$conditions = array(
					$db->quoteName('id').'='.$db->quote($arrData['id'])
			);
			$query->update($db->quoteName('thonto_tinhhinhquanly'))->set($fields)->where($conditions);
		}else{
			$query->insert($db->quoteName('thonto_tinhhinhquanly'));
			$query->set($fields);
		}
		$db->setQuery($query);
		$db->query();
		if ((isset($arrData['id'])) && ($arrData['id']>0)){
			return $arrData['id'];
		}
		else return $db->insertid();
	}
	public function luunoidunghop($tinhhinh_id, $noidunghop, $co_thuchien){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('tinhhinhquanly_id').'='.$db->quote($tinhhinh_id),
				$db->quoteName('noidunghop_id').'='.$db->quote($noidunghop),
				$db->quoteName('co_thuchien').'='.$db->quote($co_thuchien),
		);
		$query->insert($db->quoteName('thonto_thongtinhopgiaoban'));
		$query->set($fields);
		$db->setQuery($query);
		return $db->query();
	}
	public function xoanoidunghop($id){
		$db = JFactory::getDbo();
		$query=$db->getQuery(true);
		$query = 'delete from thonto_thongtinhopgiaoban where tinhhinhquanly_id ='.(int)$id;
		$db->setQuery($query);
		return $db->query();
	}
	public function getCbo($table,$field,$where=null,$order=null,$value,$text,$code,$name,$selected=null,$idname=null,$class=null,$attrArray=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array($field))
		->from($table);
		if($where != null || $where != "")
			$query->where($where);
		$query->order($order);
		$db->setQuery($query);
		// 		echo $query;die;
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value'=>$value,'text' => $text));
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
}