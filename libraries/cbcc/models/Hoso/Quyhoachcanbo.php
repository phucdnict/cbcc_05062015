<?php
class Hoso_Model_Quyhoachcanbo extends JModelLegacy {
	/**
	 * Lấy node gốc trên tree của acccount đang log
	 *
	 * @param   integer  $user->id  id account đăng nhập.
	 *
	 * @return  null|array  Trả về thông tin về node gốc.
	 *
	 */
	function getRootTree(){
		$user  = JFactory::getUser();
		$id_user = $user->id;
		$root = Core::getManageUnit($id_user);
		return $root;
	}
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
	 * Lấy thông tin Cán bộ theo donvi_id, đưa vào <select>, tự động selected option ứng với $select
	 * @param int $donvi_id donvi_id
	 * @param int $select id để selected
	 * @return string
	 */
	public function getCanboById($donvi_id,$select=null){
		// lấy danh sách cán bộ tại đơn vị theo inst_code -> từ tree, select = option đã chọn
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('hosochinh_id as id, hoten as e_name')
		->from('hosochinh_quatrinhhientai ht')
		->where('( '.$db->quoteName('ht.congtac_donvi_id').'='.$db->quote($donvi_id).' OR '.$db->quoteName('ht.congtac_phong_id').'='.$db->quote($donvi_id).')')
		->where('ht.hoso_trangthai= "00"');
		 
		$donviloaitru = Core::getUnManageDonvi(JFactory::getUser()->id, 'com_hoso', 'treeview', 'treequyhoach');
		if($donviloaitru!='')
			$query->where('ht.congtac_donvi_id NOT IN ('.$donviloaitru.') and ht.congtac_phong_id NOT IN ('.$donviloaitru.')');
		$db->setQuery($query);
		$arrCanbo = $db->loadObjectList();
		$data=array();
		array_push($data, array('value' => "",'text' => "--Chọn CBCC--"));
		for($i=0;$i<sizeof($arrCanbo);$i++){
			array_push($data, array('value' => $arrCanbo[$i]->id,'text' => $arrCanbo[$i]->e_name));
		}
		$options = array(
				'id' => 'emp_id',
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$select
		);
		return $result = JHtmlSelect::genericlist($data,'emp_id',$options);
	} 
	/**
	 * Lấy thông tin Chức bụ bằng donvi_id, tự động selected option ứng với $select 
	 * @param int $donvi_id donvi_id
	 * @param string $select id để selected
	 * @return mixed
	 */
	public function getChucvuByDonvi($donvi_id,$select=null){
		//lấy danh sách cán bộ tại đơn vị theo inst_code -> từ tree, select từ text
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.pos_system_id, a.name'))
		->from($db->quoteName('cb_goichucvu_chucvu','a'))
		->join('inner','ins_dept as b on a.goichucvu_id = b.goichucvu');
		$query->where('(b.id = '.$donvi_id.' and b.type = 1) or (b.id in (select parent_id from ins_dept where id = '.$donvi_id.' and type = 0))');
		$db->setQuery($query);
		$arrChucvu = $db->loadObjectList();
		$data=array();
		array_push($data, array('value' => "",'text' => "--Chọn chức vụ--"));
		for($i=0;$i<sizeof($arrChucvu);$i++){
			array_push($data, array('value' => $arrChucvu[$i]->pos_system_id,'text' => $arrChucvu[$i]->name));
		}
		$options = array(
				'id' => 'pos_system_id',
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>array($select)
		);
		return JHTML::_('select.genericlist',$data,'pos_system_id',$options);
	}
	/**
	 * Lấy Chức vụ tương đương bằng mã chức vụ 
	 * @param int $pos_system_id
	 * @param string $position
	 * @return string
	 */
	public function getMuctuongduongByChucvu($pos_system_id,$position){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('distinct(b.muctuongduong)'))
		->from($db->quoteName('cb_goichucvu_chucvu','a'))
		->join('inner', $db->quoteName('pos_system', 'b') . ' ON (' . $db->quoteName('a.pos_system_id') . ' = ' . $db->quoteName('b.id') . ')');
		$query->where($db->quoteName('a.pos_system_id').'='.$db->quote($pos_system_id).' AND '.$db->quoteName('a.name').'='.$db->quote($position));
		$db->setQuery($query);
		return $db->loadResult();
	}
	/**
	 * Lưu thông tin quy hoạch cán bộ, dùng chung cho thêm mới và cập nhật
	 * @param array $formData thông tin input
	 * @return boolean	
	 */
	public function saveQuyhoachcanbo($formData){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$fields = array(
				$db->quoteName('emp_id').'='.$db->quote($formData['emp_id']),
				$db->quoteName('pos_system_id').'='.$db->quote($formData['pos_system_id']),
				$db->quoteName('position').'='.$db->quote($formData['position']),
				$db->quoteName('pos_td').'='.$db->quote($this->getMuctuongduongByChucvu($formData['pos_system_id'],$formData['position'])),
				$db->quoteName('ghichu').'='.$db->quote($formData['ghichu']),
				$db->quoteName('start_year').'='.$db->quote($formData['start_year']),
				$db->quoteName('end_year').'='.$db->quote($formData['end_year']),
				$db->quoteName('status').'='.$db->quote($formData['status']),
				$db->quoteName('date_created').'= (SELECT STR_TO_DATE('.$db->quote($formData['date_created']).',\'%d/%m/%Y\'))',
		);
		if (isset($formData['id_qhcb']) && $formData['id_qhcb']>0){
			$conditions = array(
					$db->quoteName('id_qhcb').'='.$db->quote($formData['id_qhcb'])
			);
			$query->update($db->quoteName('quyhoachcanbo'))->set($fields)->where($conditions);
		}
		else{
			$query->insert($db->quoteName('quyhoachcanbo'));
			$query->set($fields);
		}
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		} else {
			return true;
		}
	}
	/**
	 * Xóa thông tin quy hoạch cán bộ
	 * @param array $arrQhcbDelete mảng thông tin chứa các id cần xóa
	 * @return boolean
	 */
	public function deleteQuyhoachcanbo($arrQhcbDelete){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$conditions = array(
				$db->quoteName('id_qhcb').' IN ('.$arrQhcbDelete['arrQhcbDelete'].')'
		);
		$query->delete($db->quoteName('quyhoachcanbo'));
		$query->where($conditions);
		$db->setQuery($query);
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		} else {
			return true;
		}
	}
	/**
	 * Thông tin chi tiết quy hoạch cán bộ khi chỉnh sửa 
	 * @param int $id_qhcb
	 * @return array
	 */
	public function thongtinQuyhoachcanboDeEdit($id_qhcb) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('id_qhcb,emp_id,start_year,end_year,pos_system_id,position,pos_td,date_created,ghichu'))
		->from($db->quoteName('quyhoachcanbo','a'));
		$query->where($db->quoteName('a.id_qhcb').'='.$db->quote($id_qhcb));
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 * Danh sách quy hoạch cán bộ
	 * @param int $donvi_id mã đơn vị
	 * @return array
	 */
	public function ds_quyhoachcanbo($donvi_id) {
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array('a.id_qhcb,a.emp_id,b.e_name,b.birth_date,c.name as phongcongtac, if(ht.congtac_chucvu_id > 0, ht.congtac_chucvu, "") as position ,a.position as positionQuyhoach,a.start_year,a.end_year,a.date_created,a.ghichu,a.pos_td'))
		->from($db->quoteName('quyhoachcanbo','a'))
		->join('inner', $db->quoteName('hosochinh', 'b') . ' ON (' . $db->quoteName('b.id') . ' = ' . $db->quoteName('a.emp_id') . ')')
		->join('inner', $db->quoteName('hosochinh_quatrinhhientai', 'ht') . ' ON (' . $db->quoteName('a.emp_id') . ' = ' . $db->quoteName('ht.hosochinh_id') . ')')
		->join('left', $db->quoteName('ins_dept', 'c') . ' ON (' . $db->quoteName('c.id') . ' = ' . $db->quoteName('ht.congtac_phong_id') . ')')
		->where('('.$db->quoteName('ht.congtac_donvi_id').'='.$db->quote($donvi_id).' OR '.$db->quoteName('ht.congtac_phong_id').'='.$db->quote($donvi_id).')')
		->where('ht.hoso_trangthai = "00"');
		$donviloaitru = Core::getUnManageDonvi(JFactory::getUser()->id, 'com_hoso', 'treeview', 'treequyhoach');
		if($donviloaitru!='')
			$query->where('ht.congtac_donvi_id NOT IN ('.$donviloaitru.') and ht.congtac_phong_id NOT IN ('.$donviloaitru.')');
		$query->order('a.start_year desc, a.pos_td asc');
		$db->setQuery($query);
		return $db->loadObjectList();
	}
}