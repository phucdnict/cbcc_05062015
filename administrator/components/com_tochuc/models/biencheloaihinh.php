<?php
class TochucModelBiencheLoaihinh extends JModelLegacy{

	public function delete($node_id){
		$table = JTable::getInstance( 'BiencheLoaihinh', 'TochucTable' );
		return $table->delete($node_id);
	}

	public function save($formData){
		$table = JTable::getInstance( 'BiencheLoaihinh', 'TochucTable' );
		//var_dump($data);exit;
		$table->bind( $formData );
		$table->check();
		$table->store();
		return $table->id;
	}

	public function read($id){
		$table = JTable::getInstance( 'BiencheLoaihinh', 'TochucTable' );
		$table->load($id);
		return $table;
	}
	public function getAll(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*')
		->from($db->quoteName('bc_loaihinh'));
		$db->setQuery($query);
		return $db->loadAssocList();
	}
}