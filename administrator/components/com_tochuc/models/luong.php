<?php
class TochucModelLuong extends JModelLegacy{
	public function delete($id){
		$table = JTable::getInstance( 'Luong', 'TochucTable' );
		$this->deleteGoiLuongNgach($id);
		return $table->delete($id);		
	}
	public function read($id){
		$table = JTable::getInstance( 'Luong', 'TochucTable' );
		$table->load($id);
		return $table;
	}
	public function save($formData){
		$table = JTable::getInstance( 'Luong', 'TochucTable' );
		$data = array(
				'ID'=>$formData['ID'],
				'NAME'=>$formData['NAME'],
				'STATUS'=>$formData['STATUS'],
				'PARENTID'=>$formData['PARENTID']				
		);
		
		foreach ($data as $key => $value) {
			if ($value == '') {
				unset($data[$key]);
			}
		}
		//var_dump($data);exit;
		$table->bind( $data );
		$table->check();
		$table->store();				
		return $table->ID;
	}
	public function deleteGoiLuongNgach($goiluong_id){
		$db = JFactory::getDbo();
		// delete
		$query = $db->getQuery(true);
		$query->delete('cb_goiluong_ngach')->where('ID_GOI = '.$db->q($goiluong_id));
		$db->setQuery($query);
		return $db->query();		
	}
	public function saveGoiLuongNgach($goiluong_id,$ngach){
		$this->deleteGoiLuongNgach($goiluong_id);
		$db = JFactory::getDbo();
		// insert		
		for ($i = 0; $i < count($ngach); $i++) {
			$values = array();
			$values[] = $db->q($goiluong_id);
			$values[] = $db->q($ngach[$i]);
			$query = $db->getQuery(true);
			$query->insert('cb_goiluong_ngach')
				->columns($db->quoteName(array('ID_GOI','NGACH')))
				->values(implode(',', $values));
			$db->setQuery($query);
			$db->query();
		}
	}
}