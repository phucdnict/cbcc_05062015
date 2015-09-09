<?php
class Thonto_Model_Tinhhinhhoatdong{
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
	public function luutinhhinhhoatdong($arrData){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('thonto_id').'='.$db->quote($arrData['thonto_id']),
				$db->quoteName('dotbaocao_id').'='.$db->quote($arrData['dotbaocao_id']),
				$db->quoteName('dinhky_solan').'='.$db->quote($arrData['dinhky_solan']),
				$db->quoteName('dotxuat_solan').'='.$db->quote($arrData['dotxuat_solan']),
				$db->quoteName('thanhphan_daydu').'='.$db->quote($arrData['thanhphan_daydu']),
				$db->quoteName('thanhphan_khongdaydu').'='.$db->quote($arrData['thanhphan_khongdaydu']),
				$db->quoteName('sohothamgia').'='.$db->quote($arrData['sohothamgia']),
				$db->quoteName('tyle').'='.$db->quote($arrData['tyle']),
				$db->quoteName('hopquandanchinh_solan').'='.$db->quote($arrData['hopquandanchinh_solan']),
				$db->quoteName('thaythetotruong_soluong').'='.$db->quote($arrData['thaythetotruong_soluong']),
				$db->quoteName('nhiemvutrongtam').'='.$db->quote($arrData['nhiemvutrongtam']),
		);
		if ((isset($arrData['id'])) && ($arrData['id']>0)){
			$conditions = array(
					$db->quoteName('id').'='.$db->quote($arrData['id'])
			);
			$query->update($db->quoteName('thonto_tinhhinhhoatdong'))->set($fields)->where($conditions);
		}else{
			$query->insert($db->quoteName('thonto_tinhhinhhoatdong'));
			$query->set($fields);
		}
		$db->setQuery($query);
		$db->query();
		if ((isset($arrData['id'])) && ($arrData['id']>0)){
			return $arrData['id'];
		}
		else return $db->insertid();
	}
	public function luuxulykiennghi($tinhhinh_id, $kiennghi, $soluong, $thonto, $px, $qh){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('tinhhinhhoatdong_id').'='.$db->quote($tinhhinh_id),
				$db->quoteName('kiennghi_id').'='.$db->quote($kiennghi),
				$db->quoteName('soluongkiennghi').'='.$db->quote($soluong),
				$db->quoteName('dagiaiquyet_thonto').'='.$db->quote($thonto),
				$db->quoteName('dagiaiquyet_phuongxa').'='.$db->quote($px),
				$db->quoteName('dagiaiquyet_quanhuyentrolen').'='.$db->quote($qh),
		);
		$query->insert($db->quoteName('thonto_xulykiennghi'));
		$query->set($fields);
		$db->setQuery($query);
		return $db->query();
	}
	public function xoaxulykiennghi($id){
		$db = JFactory::getDbo();
		$query=$db->getQuery(true);
		$query = 'delete from thonto_xulykiennghi  where tinhhinhhoatdong_id ='.(int)$id;
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
	public function selectBox($value,$attrs,$table,$colums,$where = null,$order = null){
		if (count($colums) >= 2) {
	
			if (isset($table) && is_array($table)) {
				$rows = $table;
			}else{
				$rows = ThontoHelper::collect($table, $colums, $where);
			}
			if (is_array($attrs)) {
				$controlName = $attrs['name'];
				if ($controlName) {
					$controlAttrs = " ng-model=\"".$controlName."\"";
				}
				unset($attrs['name']);
				unset($attrs['value']);
				foreach ($attrs as $key=>$val){
					if (is_array($val)) {
						$controlAttrs .=" ".$key.'="'.implode(" ", $val).'"';
					}else{
						$controlAttrs .=" ".$key.'="'.$val.'"';
					}
				}
			}else{
				$controlAttrs = $attrs;
			}
			if (isset($attrs['hasEmpty']) && $attrs['hasEmpty'] == true) {
				$option = array("$colums[0]"=>'',"$colums[1]"=>'');
				array_unshift($rows, $option);
			}
	
			return JHTML::_('select.genericlist',$rows,$controlName, $controlAttrs, $colums[0],$colums[1],$value);
		}
		return '';
	}
}