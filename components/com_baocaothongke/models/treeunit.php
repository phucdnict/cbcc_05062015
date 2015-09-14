<?php
class BaocaothongkeModelTreeunit extends JModelList
{
	var $session;
	
	function __construct(){				
		parent::__construct();
		
		$this->session =& JFactory::getSession();
	}
	function _getNumChildren($id,$field){
		$query = "select id from config_donvi_bc where $field = $id ";
		$data = $this->_getListCount($query);
		return $data;
	}
	function _buildQuerySelect(){
		$query = 'select a.id, a.ins_dept, a.parent_id, a.`name`, a.level, b.type as type from config_donvi_bc as a
				INNER JOIN ins_dept as b on a.ins_dept = b.id ';
		return $query;
	}
	
	function getTree(){
		$id = JRequest::getInt('id');
		$root_id = JRequest::getInt('root_id');
		$report_group_code = JRequest::getVar('report_group_code');
		$arrTypes = array('file','folder','root');
	
		$query = $this->_buildQuerySelect();
		if($this->session->get('isRoot') == 1){
			// Hiễn thị node cha thì where a.id. Nếu ko hiễn thị node cha thì where a.parent_id
			$query .= '	where a.id = '.$id.' AND a.report_group_code = "'.$report_group_code.'"';
			$this->session->set('isRoot',0);
		}else{
			$query .= '	where a.parent_id = '.$id.' AND a.report_group_code = "'.$report_group_code.'" order by name ';
		}
		$data = $this->_getList($query);
	
		foreach ($data as $dt){
			$numChild = $this->_getNumChildren($dt->id,'parent_id');
	
			$types = '';
			$result[] = array(
					"attr" => array(
							"id" => "node_".$dt->id,
							"rel" => $arrTypes[$dt->type],
							// 							"loaihinh" => $dt->ins_loaihinh,
							"ins_dept" => $dt->ins_dept,
							"name" => $dt->name,
							"type" => $dt->type,
							"exp_level"=>$dt->level    // Mới thêm để test level
					),
					"data" => $dt->name,//.' '.$dt->id,
					"state" => ($numChild == 0) ? "" : "closed"
			);
		}
		return json_encode($result);
	
	}
	// Phúc thêm
	public function treeViewThongke($id_parent, $option=array()){
		$db = JFactory::getDbo();
		$exceptionUnits = Core::getUnManageDonvi(JFactory::getUser()->id, $option['component'], $option['controller'], $option['task']);
		$exception_condition = ($exceptionUnits)?' AND a.id NOT IN ('.$exceptionUnits.')':'';
		$where = ($option['condition'])?' AND '.$option['condition']:'';
		$query = 'SELECT a.id,a.parent_id,a.type,a.name,a.level,a.lft,a.rgt,a.active
					FROM ins_dept AS a
					WHERE a.active = 1  AND a.parent_id = '.$db->quote($id_parent).$exception_condition.$where.'
					ORDER BY a.lft';
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$arrTypes = array('file','folder','root');
		for ($i=0,$n=count($rows);$i<$n;$i++){
			$types = '';
			$result[] = array(
					"attr" => array("id" => "node_".$rows[$i]['id'], "rel" => $arrTypes[$rows[$i]['type']], "showlist" => $rows[$i]['type']),
					"data" => $rows[$i]['name'],
					"state" => ((int)$rows[$i]['rgt'] - (int)$rows[$i]['left'] > 1) ? "closed" : ""
			);
		}
		return json_encode($result);
	}
	
	
	
	
	
	
	
	
		
}