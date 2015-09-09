<?php
/**
 * Author: Phucnh
 * Date created: Aug 13, 2015
 * Company: DNICT
 */
class ThontosModelTreeview extends JModelLegacy{
	public function treeThonto($id_parent, $option=array()){
		$db = JFactory::getDbo();
		$where = ($option['condition'])?' AND '.$option['condition']:'';
		$query = 'SELECT a.id,a.parent_id,a.kieu,a.ten,a.level,a.lft,a.rgt,a.trangthai_id, a.donvi_id
					FROM thonto_tochuc AS a
					WHERE a.trangthai_id = 1  AND a.parent_id = '.$db->quote($id_parent).$where.'
					ORDER BY a.lft';
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$arrTypes = array('root','root','root','root','folder','folder');
		for ($i=0,$n=count($rows);$i<$n;$i++){
			$result[] = array(
					"attr" => array(	"id" => "node_".$rows[$i]['id'], 
											"rel" => $arrTypes[$rows[$i]['kieu']], 
											"showlist" => $rows[$i]['kieu'],
											"px_id" => $rows[$i]['donvi_id'],
											"hosochinh_id" => $rows[$i]['hosochinh_id']
											),
					"data" => $rows[$i]['ten'],
					"state" => ((int)$rows[$i]['rgt'] - (int)$rows[$i]['lft'] > 1) ? "closed" : ""
			);
		}
		return json_encode($result);
	}
	public function treeViewTochuc($id_parent, $option=array()){
		$db = JFactory::getDbo();
		$exceptionUnits = Core::getUnManageDonvi(JFactory::getUser()->id, $option['component'], $option['controller'], $option['task']);
		$exception_condition = ($exceptionUnits)?' AND a.id NOT IN ('.$exceptionUnits.')':'';
		$where = ($option['condition'])?' AND '.$option['condition']:'';
		$query = 'SELECT a.id,a.parent_id,a.type,a.name,a.level,a.lft,a.rgt,a.active, ins_cap
					FROM ins_dept AS a
					WHERE a.active = 1  AND a.parent_id = '.$db->quote($id_parent).$exception_condition.$where.'
					ORDER BY a.lft';
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$arrTypes = array('file','folder','root');
		for ($i=0,$n=count($rows);$i<$n;$i++){
			$types = '';
			$result[] = array(
					"attr" => array("id" => "node_".$rows[$i]['id'], 
							"rel" => $arrTypes[$rows[$i]['type']], 
							"ins_cap" => $rows[$i]['ins_cap'], 
							"showlist" => $rows[$i]['type']
					),
					"data" => $rows[$i]['name'],
					"state" => ((int)$rows[$i]['rgt'] - (int)$rows[$i]['left'] > 1) ? "closed" : ""
			);
		}
		return json_encode($result);
	}
}