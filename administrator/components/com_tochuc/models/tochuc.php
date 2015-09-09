<?php
class TochucModelTochuc extends JModelLegacy{

	public function rebuild(){
		$table = JTable::getInstance( 'Tochuc', 'TochucTable' );
		return $table->rebuild();		
	}
	public function orderUp($id){
		$table = JTable::getInstance( 'Tochuc', 'TochucTable' );
		//var_dump($id);
		return $table->orderUp( $id );
	}
	public function orderDown($id){
		$table = JTable::getInstance( 'Tochuc', 'TochucTable' );
		//var_dump($id);
		return $table->orderDown( $id );
	}
}