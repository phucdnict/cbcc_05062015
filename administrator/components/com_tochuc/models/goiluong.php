<?php
class TochucModelGoiluong extends JModelLegacy{
	public function delete($id){
		$table = JTable::getInstance( 'Goiluong', 'TochucTable' );
		$this->deleteGoiLuongNgach($id);
		return $table->delete($id);		
	}
	public function rebuild(){
		$table = JTable::getInstance( 'Goiluong', 'TochucTable' );
		return $table->rebuild();
	}
	public function read($id){
		$table = JTable::getInstance( 'Goiluong', 'TochucTable' );
		$table->load($id);
		return $table;
	}
	public function save($formData){
		$table = JTable::getInstance( 'Goiluong', 'TochucTable' );
		$reference_id = (int)$formData['parent_id'];
		$table->setLocation( $reference_id, 'last-child' );
		$data = array(
				'id'=>$formData['id'],
				'name'=>$formData['name'],
				'status'=>$formData['status']				
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
		return $table->id;
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
	public function moveNode($id,$parent_id){
		$table = JTable::getInstance( 'Goiluong', 'TochucTable' );
		$table->load($id);
		$table->parent_id = $parent_id;
		return $table->store();
	}
}