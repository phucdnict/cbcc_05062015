<?php
defined('_JEXEC') or die( 'Restricted access' );
class Kekhaitaisan_Model_Kekhaitaisan extends JModelLegacy{
	/**
	 * 
	 * @param array|string $field
	 * @param string $table
	 * @param array $arrJoin ar(key, val)
	 * @param array $where arr(val, val)
	 * @param string $order
	 * @return Object
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
	/**
	 * combobox quan hệ nhân thân vợ/chồng/ vợ kế
	 * @param string $select
	 * @param string $id
	 * @return string
	 */
	public function getCboRelation($select=null,$id=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.id','a.name'))
		->from($db->quoteName('relative_code','a'))
		->where('a.status=1 and id IN (3,12,4,19,8)');
		$query->order('a.name asc');
		$db->setQuery($query);
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value','text' => '--Chọn quan hệ--'));
		for($i=0;$i<count($tmp);$i++){
			array_push($data, array('value' => $tmp[$i]->id,'text' => $tmp[$i]->name));
		}
		$options = array(
				'id' => $id,
				'list.attr' => array( // additional HTML attributes for select field
						'class'=>'chosen',
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,$id,$options);
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
	 * Lưu thông tin nhân thân
	 * @param unknown $hoso_id
	 * @param unknown $relative_code_id
	 * @param array $arrData
	 * @return boolean
	 */
	public function saveNhanthan($hosochinh_id, $kekhai_id, $arrData){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('kekhai_id').'='.$db->quote($kekhai_id),
				$db->quoteName('relative_code_id').'='.$db->quote($arrData['relative_code_id']),
				$db->quoteName('hoso_id').'='.$db->quote($hosochinh_id),
				$db->quoteName('hoten').'='.$db->quote(urldecode($arrData['hoten'])),
				$db->quoteName('namsinh').'='.$db->quote($arrData['namsinh']),
				$db->quoteName('chucvu').'='.$db->quote(urldecode($arrData['chucvu'])),
				$db->quoteName('coquan').'='.$db->quote(urldecode($arrData['coquan'])),
				$db->quoteName('hokhau_tinhthanh').'='.$db->quote($arrData['hokhau_tinhthanh']),
				$db->quoteName('hokhau_quanhuyen').'='.$db->quote($arrData['hokhau_quanhuyen']),
				$db->quoteName('hokhau_phuongxa').'='.$db->quote($arrData['hokhau_phuongxa']),
				$db->quoteName('choohientai').'='.$db->quote(urldecode($arrData['choohientai']))
		);
		if ((isset($arrData['id'])) && ($arrData['id']>0)){
			$conditions = array(
					$db->quoteName('id').'='.$db->quote($arrData['id'])
			);
			$query->update($db->quoteName('kkts_hoso_nhanthan'))->set($fields)->where($conditions);
		}else{
			$query->insert($db->quoteName('kkts_hoso_nhanthan'));
			$query->set($fields);
		}
		$db->setQuery($query);
		if (!$db->execute()) return false;
		else return true;
	}
	/**
	 * Kiểm tra thông tin kê khai mới hay đã tồn tại, true nếu đã tồn tại
	 * @param unknown $emp_id
	 * @return boolean
	 */
	public function checkKekhai($hoso_id,$dotkekhai_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('user_id, id, dotkekhai_id, ngaykekhai'))->from($db->quoteName('kkts_kekhai'));
		$query->where(' user_id='.$hoso_id.' and dotkekhai_id ='.$dotkekhai_id);
		$db->setQuery($query);
		$row = $db->loadObjectList();
		if (count($row)>0)
			return true;
		else
			return false;
	}
	/**
	 * Lấy thông tin người kê khai tài sản từ bảng hosochinh_quatrinhhientai
	 * @param int $hoso_id
	 * @return array
	 */
	public function getInfoNguoikekhai($hoso_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.hoten','a.hosochinh_id','a.ngaysinh','a.congtac_chucvu','a.congtac_donvi'
				,'c.per_residence','city.name as city_peraddress','dist.name as dist_peraddress','comm.name as comm_peraddress'))
				->from($db->quoteName('hosochinh_quatrinhhientai','a'))
				->join('inner',$db->quoteName('hosochinh','c') . 'ON ('. $db->quoteName('a.hosochinh_id').' = '.$db->quoteName('c.id').')')
				->join('left', 'comm_code comm ON comm.code = c.comm_peraddress')
				->join('left', 'dist_code dist ON dist.code = c.dist_peraddress')
				->join('left', 'city_code city ON city.code = c.city_peraddress')
				->where($db->quoteName('hosochinh_id').'='.$db->quote($hoso_id));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Lấy hoso_id bằng id đăng nhập
	 * @param int $josUser
	 * @return array
	 */
	public function getHosoidByJos($josUser){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('hoso_id'))
		->from($db->quoteName('core_user_hoso','hs'))
		->join('inner', $db->quoteName('jos_users', 'a') . ' ON (' . $db->quoteName('a.id') . ' = ' . $db->quoteName('hs.user_id') . ')')
		->join('inner', $db->quoteName('hosochinh', 'b') . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('hs.hoso_id') . ')');
		$query->where($db->quoteName('a.id').'='.$db->quote($josUser));
		$db->setQuery($query);
		return $db->loadResult();
	}
	/**
	 * Lấy thông tin thân nhân của người kê khai tài sản, xuất ra bảng
	 * @param string $hoso_id
	 * @param string $relative_code_id
	 * @return array
	 */
	public function getNhanthan($kekhai_id=null){
		$db	=	JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('nt.*', 'rela.name as quanhe'))
		->from($db->quoteName('kkts_hoso_nhanthan', 'nt'))
		->join('inner', 'relative_code rela ON rela.id = nt.relative_code_id');
		$query->where(' rela.status =1 and nt.kekhai_id ='.$kekhai_id);
		$query->order('nt.namsinh asc');
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Lấy thông tin thân nhân
	 * @param string $nhanthan_id
	 * @return array
	 */
	public function getNhanthanchitiet($nhanthan_id){
		$db	=	JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('nt.*'))
		->from($db->quoteName('kkts_hoso_nhanthan', 'nt'));
		$query->where('nt.id ='.$nhanthan_id);
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Lấy Kekhai_id
	 * @param unknown $hoso_id
	 * @param unknown $dotkekhai_id
	 * @return Ambigous <mixed, NULL>
	 */
	public function getKekhaiid($hoso_id,$dotkekhai_id){
		$db = JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('id'))->from($db->quoteName('kkts_kekhai'));
		$query->where(' user_id='.$hoso_id.' and dotkekhai_id ='.$dotkekhai_id);
		$db->setQuery($query);
		$db->execute();
		return $db->loadResult();
	}
	/**
	 * Lưu / cập nhật bảng kê khai kkts_kekhai theo đợt...
	 * @param unknown $hoso_id
	 * @param unknown $dotkekhai_id
	 */
	public function saveKekhai($hoso_id,$dotkekhai_id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('user_id').'='.$db->quote($hoso_id),
				$db->quoteName('ngaykekhai').'='.$db->quote(date("Y-m-d")),
				$db->quoteName('dotkekhai_id').'='.$db->quote($dotkekhai_id),
		);
		$conditions = array(
				$db->quoteName('user_id').'='.$hoso_id,
				$db->quoteName('dotkekhai_id').'='.$dotkekhai_id,
		);
		if($this->checkKekhai($hoso_id,$dotkekhai_id)==true){
			// update
			$query->update($db->quoteName('kkts_kekhai'))->set($fields)->where($conditions);
		}else {
			//insert
			$query->insert($db->quoteName('kkts_kekhai'));
			$query->set($fields);
		}
		$db->setQuery($query);
		$db->execute();
	}
	/**
	 * Lấy đợt kê khai mới nhất của người đang login (hoso_id)
	 * @param unknown $hoso_id
	 * @return unknown
	 */
	public function getLastDotkekhai($hoso_id=null){
		$db = JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select('b.id')
		->from($db->quoteName('kkts_dotkekhai','b'));
		$query->join('inner',$db->quoteName('kkts_kekhai','kk') . 'ON ('. $db->quoteName('b.id').' = '.$db->quoteName('kk.dotkekhai_id').')')
		->where($db->quoteName('kk.user_id'). '=' . $db->quote($hoso_id));
		$query->order('b.orders DESC');
		$db->setQuery($query);
		$db->execute();
		return $db->loadResult();
	}
	/**
	 * Xóa thông tin nhân thân
	 * @param unknown $id_nhanthan
	 * @return boolean
	 */
	public function xoanhanthan($arr_id){
		$id_nhanthan = implode($arr_id,',');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array(
				$db->quoteName('id').' IN ('.$id_nhanthan.')',
		);
		$query->delete($db->quoteName('kkts_hoso_nhanthan'));
		$query->where($conditions);
		$db->setQuery($query);
		$db->execute();
		if (!$db->query()) {
			return false;
		} else {
			return true;
		}
	}
	/**
	 * Lưu thông tin tài sản nhà
	 * @param unknown $hoso_id
	 * @param array $taisannha
	 * @return boolean
	 */
	public function saveTaisan($kekhai_id, $formData){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		if((int)$formData['taisan_id'] >0) $taisan_id = $formData['taisan_id'];
		else $taisan_id = $formData['loaitaisan_id'];
		$fields = array(
				$db->quoteName('kekhai_id').'       ='.$db->quote($kekhai_id),
				$db->quoteName('value').'           ='.$db->quote($formData['value']),
				$db->quoteName('taisan_id').'       ='.$db->quote($taisan_id),
				$db->quoteName('loainha_id').'      ='.$db->quote($formData['loainha_id']),
				$db->quoteName('capcongtrinh_id').' ='.$db->quote($formData['capcongtrinh_id']),
				$db->quoteName('dientich').'        ='.$db->quote($formData['dientich']),
				$db->quoteName('trigia').'          ='.$db->quote($formData['giatri']),
				$db->quoteName('giaychungnhan').'   ='.$db->quote($formData['giaychungnhan']),
				$db->quoteName('thongtinkhac').'    ='.$db->quote($formData['thongtinkhac']),
				$db->quoteName('type').'            ='.$db->quote($formData['type']),
				$db->quoteName('diachi').'          ='.$db->quote($formData['diachi'])
		);
		if ((isset($formData['id'])) && ($formData['id']>0)){
			$conditions = array(
					$db->quoteName('id').'='.$db->quote($formData['id'])
			);
			$query->update($db->quoteName('kkts_kekhai_chitiet'))->set($fields)->where($conditions);
		}else{
			$query->insert($db->quoteName('kkts_kekhai_chitiet'));
			$query->set($fields);
		}
		$db->setQuery($query);
		if (!$db->execute()) return false;
		else return true;
	}
	/**
	 * Lấy all thông tin tài sản
	 * @param int $kekhai_id
	 * @return Ambigous <mixed, NULL, multitype:unknown mixed >
	 */
	public function gettaisan($kekhai_id){
		$db	=	JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('t.parent_id,ts.*, ln.name as loainha_name, cct.name as capcongtrinh_name, t.tenloaitaisan, t.type'))
		->from ($db->quoteName('kkts_kekhai_chitiet', 'ts'));
		$query->join('left','kkts_loainha ln ON ln.id = ts.loainha_id')
		->join('left', 'kkts_capcongtrinh cct ON cct.id = ts.capcongtrinh_id')
		->join('inner','kkts_taisan t ON t.id = ts.taisan_id');
		$query->where($db->quoteName('ts.kekhai_id').' = '.$db->quote($kekhai_id));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Xóa thông tin nhà + đất + tài sản khác trước khi insert
	 * @param unknown $kekhai_id
	 * @return mixed
	 */
	public function xoataisan($id){
		$id_taisan = implode($id,',');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array(
				$db->quoteName('id').' IN ('.$id_taisan.')',
		);
		$query->delete($db->quoteName('kkts_kekhai_chitiet'));
		$query->where($conditions);
		$db->setQuery($query);
		if (!$db->execute()) return false;
		else return true;
	}
	public function gettaisanparent($taisan_id){
		$db	=	JFactory::getDbo();
		$query	=	$db->getQuery(true);
		$query->select(array('ts.parent_id'))
		->from ($db->quoteName('kkts_kekhai_chitiet', 'ct'));
		$query
		->join('inner','kkts_taisan ts ON ts.id = ct.taisan_id');
		$query->where($db->quoteName('ct.taisan_id').' = '.$db->quote($taisan_id));
		$db->setQuery($query);
		return $db->loadResult();
	}
}