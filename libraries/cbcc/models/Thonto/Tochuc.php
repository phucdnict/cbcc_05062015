<?php
/**
 * Author: Phucnh
 * Date created: Aug 13, 2015
 * Company: DNICT
 */
class Thonto_Model_Tochuc{
	public function luusoluongkhongchuyentrach($formData){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('thonto_id').'='.$db->quote($formData['thonto_id']),
				$db->quoteName('chibo_bithu').'='.$db->quote($formData['chibo_bithu']),
				$db->quoteName('chibo_phobithu').'='.$db->quote($formData['chibo_phobithu']),
				$db->quoteName('bancongtac_truongban').'='.$db->quote($formData['bancongtac_truongban']),
				$db->quoteName('bancongtac_phoban').'='.$db->quote($formData['bancongtac_phoban']),
				$db->quoteName('chihoiphunu').'='.$db->quote($formData['chihoiphunu']),
				$db->quoteName('chihoicuuchienbinh').'='.$db->quote($formData['chihoicuuchienbinh']),
				$db->quoteName('bithudoantn').'='.$db->quote($formData['bithudoantn']),
				$db->quoteName('chihoinongdan').'='.$db->quote($formData['chihoinongdan']),
				$db->quoteName('todanvan').'='.$db->quote($formData['todanvan']),
				$db->quoteName('baovedanpho').'='.$db->quote($formData['baovedanpho']),
				$db->quoteName('conganvien').'='.$db->quote($formData['conganvien']),
				$db->quoteName('thonto_truong').'='.$db->quote($formData['thonto_truong']),
				$db->quoteName('thonto_pho').'='.$db->quote($formData['thonto_pho']),
		);
		if ((isset($formData['id'])) && ($formData['id']>0)){
			$conditions = array(
					$db->quoteName('id').'='.$db->quote($formData['id'])
			);
			$query->update($db->quoteName('thonto_canbochuyentrach'))->set($fields)->where($conditions);
		}else{
			$query->insert($db->quoteName('thonto_canbochuyentrach'));
			$query->set($fields);
		}
		$db->setQuery($query);
		if(!$db->query()) return false;
		else return true;
	}
	/**
	 * Lưu thông tin tổ chức
	 * @param array $formData
	 */
	public function savethanhlap($formData){
		$table =  Core::table('Thonto/Tochuc');
		$reference_id = (int)$formData['parent_id_content'];
		$data = array(
				'id'=>$formData['id'],
				'parent_id'=>$formData['parent_id_content'],
				'kieu'=>$formData['type_content'],
				'ten'=>$formData['ten'],
				'tenviettat'=>$formData['tenviettat'],
				'soquyetdinhthanhlap'=>$formData['soquyetdinhthanhlap'],
				'ngayquyetdinhthanhlap'=>$formData['ngayquyetdinhthanhlap']==null ? null : date('Y-m-d', strtotime($formData['ngayquyetdinhthanhlap'])),
				'tongsodan'=>$formData['tongsodan'],
				'tongsoho'=>$formData['tongsoho'],
				'dientichtunhien'=>$formData['dientichtunhien'],
				'chibo_id'=>$formData['chibo_id'],
				'donvi_id'=>$formData['donvi_id'],
				'ghichu'=>$formData['ghichu'],
				'hosochinh_id'=>$formData['hosochinh_id'],
				'trangthai_id'=>1,
		);
		if((int)$formData['id'] == 0){
			if ($reference_id == 0 ) {
				$reference_id = $table->getRootId();
			}
			if ($reference_id === false) {
				$reference_id = $table->addRoot();
			}
			$table->setLocation( $reference_id, 'last-child' );
			// Bind data to the table object.
			unset($data['id']);
			foreach ($data as $key => $value) {
				if ($value == '' || $value == null) {
					unset($data[$key]);
				}
			}
			$table->bind( $data );
			$table->check();
			$table->store();
			return $table->id;
		}else{
			
			if($reference_id != Core::loadResult('thonto_tochuc', array('parent_id'), array('id = '=>$formData['id']))){
				$table->setLocation( $reference_id, 'last-child' );
			}
			$table->bind($data);
			$table->check();
			$table->store();
			Core::update('thonto_tochuc', $data, 'id',true);
			// cập nhật thông tin Thôn tổ con, nếu phường xã update
			if ($formData['type_content'] == 3){
				$this->capnhatThonto($table->id, $formData['donvi_id'], $formData['hosochinh_id']);
			}
			return $table->id;
		}
	}
	/**
	 * Cập nhật donvi_id và hosochinh_id cho node con khi node cha thay đổi thoogn tin phường
	 * @param unknown $id
	 * @param number $donvi_id
	 * @param number $hosochinh_id
	 * @return mixed
	 */
	function capnhatThonto($id, $donvi_id, $hosochinh_id){
		$hosochinh_id = $hosochinh_id==null ? 0:$hosochinh_id;
		$donvi_id = $donvi_id==null ? 0:$donvi_id;
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query = "update thonto_tochuc set donvi_id =$donvi_id , hosochinh_id = $hosochinh_id where parent_id= $id";
		$db->setQuery($query);
		return $db->query();
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
	/**
	 * Xóa thôn tổ
	 * @param int $id
	 * @return mixed
	 */
	public function xoathonto($id){
		$db = JFactory::getDbo();
		$query=$db->getQuery(true);
		$query = 'update thonto_tochuc set trangthai_id = 0 where id ='.$db->quote($id);
		$db->setQuery($query);
		return $db->query();
	}
	/**
	 * Hàm reset lại cây đơn vị
	 */
	public function rebuild(){
		$table = Core::table('Thonto/Tochuc');
		return $table->rebuild();
	}
	public function orderup($id){
		$table = Core::table('Thonto/Tochuc');
		return $table->orderUp($id);
	}
	public function orderdown($id){
		$table = Core::table('Thonto/Tochuc');
		return $table->orderDown($id);
	}
}