<?php
class TochucModelCap extends JModelLegacy{
	
	public function delete($node_id){
		$table = JTable::getInstance( 'Cap', 'TochucTable' );
		return $table->delete($node_id);
	}
	public function moveNode($node_id,$reference_id){
		$table = JTable::getInstance( 'Cap', 'TochucTable' );
		$table->load($node_id);
		$table->parent_id = $reference_id;
		$table->check();
		return $table->store();
	}
	public function save($formData){
		
		$table = JTable::getInstance( 'Cap', 'TochucTable' );
		$reference_id = (int)$formData['parent_id'];
		if ($reference_id == 0 ) {
			$reference_id = $table->getRootId();
		}
		if ($reference_id === false) {
			$reference_id = $table->addRoot();
		}
		// Bind data to the table object.
		if (count($formData) > 0 ) {
			foreach ($formData as $key => $value) {
				if ($value == '') {
					unset($formData[$key]);
				}
			}
		}
		//var_dump($formData);exit;
		//check new or edit
		if ((int)$formData['id'] > 0 ) {
			$table->load($formData['id']);
			if ($table->parent_id == $reference_id) {
				unset($formData['parent_id']);
				$table->bind( $formData );
				$table->store();
			}else{
				$table->setLocation( $reference_id, 'last-child' );
				$table->bind( $formData );
				$table->check();
				$table->store();
			}
		}else{
			//new
			$table->setLocation( $reference_id, 'last-child' );
			$table->bind( $formData );
			// Force a new node to be created.
			$table->id = 0;			
			// Check that the node data is valid.
			$table->check();			
			// Store the node in the database table.
			$table->store(true);			
		}
		return $table->id;
	}
	 
	public function read($id){
		$table = JTable::getInstance( 'Cap', 'TochucTable' );
		$table->load($id);
		return $table;	
	}
	public function update($formData){
		$table = JTable::getInstance( 'Cap', 'TochucTable' );
		$reference_id = (int)$formData['parent_id'];
		// Specify where to insert the new node.
		$table->setLocation( $reference_id, 'last-child' );
		// Bind data to the table object.
		if (count($formData) > 0 ) {
			foreach ($formData as $key => $value) {
				if ($value == '') {
					unset($formData[$key]);
				}
			}
		}
		$table->bind( $formData );
		// Check that the node data is valid.
		$table->check();
		// Store the node in the database table.
		$table->store(true);
		return $table->id;
	}
	public function getSubTree($node_id){
		//echo $parent_id;
		//JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
		$table = JTable::getInstance( 'Cap', 'TochucTable' );
		return $table->getTree($node_id,true);
		//return $table->getNextOrder('parent_id = '.(int)$node_id);		
	}
}