<?php
class Tochuc_Model_InsCap{
	public function findAll($params = null,$order = null,$offset = null,$limit = null){
		$table = Core::table('Tochuc/InsCap');
		$db = $table->getDbo();
		$query = $db->getQuery(true);
		$query->select(array('*'))
		->from($table->getTableName())
		;
		if (isset($params['name']) && !empty($params['name'])) {
			$query->where('name LIKE ('.$db->quote('%'.$params['name'].'%').')');
		}
		if ($order == null) {
			$query->order('lft');
		}else{
			$query->order($order);
		}
	
		if($offset != null && $limit != null){
			$db->setQuery($query,$offset,$limit);
		}else{
			$db->setQuery($query);
		}
		return $db->loadAssocList();
		//return $table->delete($id);
	}
	public function rebuild(){
		$table = Core::table('Tochuc/InsCap');
		return $table->rebuild();
	}
	public function orderUp($id){
		$table = Core::table('Tochuc/InsCap');
		//var_dump($id);
		return $table->orderUp( $id );
	}
	public function orderDown($id){
		$table = Core::table('Tochuc/InsCap');
		//var_dump($id);
		return $table->orderDown( $id );
	}
}