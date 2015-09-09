	<?php
class AdminTochucHelper{
	static public function buildTreeHtml($values,$table,$colums,$where = null,$order=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
		->select($colums)
		->from($table);
		if ($order != null && is_string($order)) {
			$query->order($order);
		}else{
			$query->order('lft');
		}
		if ($where != null) {
			$query->where($where);
		}
		$query->where('id != 1');
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		$current_depth = 1;
		$counter = 0;
		$result = '<ul>';
		foreach ( $rows as $node ) {
			$node_depth = $node ['level'];
			$node_name = $node ['name'];
			$node_id = $node ['id'];
				
			if ($node_depth == $current_depth) {
				if ($counter > 0)
					$result .= '</li>';
			} elseif ($node_depth > $current_depth) {
				$result .= '<ul>';
				$current_depth = $current_depth + ($node_depth - $current_depth);
			} elseif ($node_depth < $current_depth) {
				$result .= str_repeat ( '</li></ul>', $current_depth - $node_depth ) . '</li>';
				$current_depth = $current_depth - ($current_depth - $node_depth);
			}
			$result .= '<li id="c' . $node_id . '"';
			$result .= $node_depth < 2 ? ' class="open"' : '';
			$result .= '><a href="#"><ins>&nbsp;</ins>' . $node_name . '</a>';
			++ $counter;
		}
		$result .= str_repeat ( '</li></ul>', $node_depth ) . '</li>';
		$result .= '</ul>';
		return $result;
	
	}
	static public function printJson($data){
		$callback = JRequest::getString('callback');
		$data=json_encode($data);
		header("HTTP/1.0 200 OK");
		header('Content-type: application/json; charset=utf-8');
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Pragma: no-cache");
		if (!empty($callback)){
			echo $callback . '(',$data, ');';
		}else{
			echo $data;
		}
		die;
	}
	static public function getNameById($id,$table,$columns = 'name',$key='id'){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName($columns))->from($db->quoteName($table))		
			  ->where($db->quoteName($key).' = '.$db->q($id));
		
			
		$db->setQuery($query);
		//echo $query->__toString();
		return $db->loadResult();
	}
	static public function getTypeById($id,$table,$columns = 'type',$key='id'){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName($columns))->from($db->quoteName($table))
		->where($db->quoteName($key).' = '.$db->q($id));
	
			
		$db->setQuery($query);
// 		echo $query->__toString();
		return $db->loadResult();
	}
	static public function selectBoxTree($value,$name,$attribs,$table,$where = null){		
			$db = JFactory::getDbo();	
			//var_dump($node);
			$query = $db->getQuery(true);
			$query->select(array('id AS value','CONCAT(REPEAT(\'--\', level-1), name) AS text'))->from($db->quoteName($table))->order('lft');
			///var_dump($where);
			if ($where != null) {
				$query->where($where);
			}
			//echo $query->__toString();
			$db->setQuery($query);
			$rows = $db->loadAssocList();
			//array_merge(array('value'=>'','text'=>''),$rows);
			array_unshift($rows, array('value'=>'','text'=>''));
			return JHtmlSelect::genericlist($rows, $name,$attribs, 'value', 'text', $value);
		
	}
	static public function getSelectParent($id,$parent_id,$name,$attribs){
		$db = JFactory::getDbo();
		$node = false;
		if ((int)$id > 0) {
			$query='SELECT lft,rgt FROM ins_cap WHERE id = '.$id;
			$db->setQuery($query);
			$node = $db->loadAssoc();
		}
		//var_dump($node);
		$query = $db->getQuery(true);
		$query->select(array('id AS value','CONCAT(REPEAT(\'--\', level), name) AS text'))->from('ins_cap')->order('lft');
		if ($node != false) {
			$query->where('id NOT IN (SELECT id FROM ins_cap WHERE lft >= '.$node['lft'].' AND rgt <= '.$node['rgt'].')');
		}
		//echo $query->__toString();		
		$db->setQuery($query);
		$rows = $db->loadAssocList();
		//array_merge(array('value'=>'','text'=>''),$rows);
		array_unshift($rows, array('value'=>'','text'=>''));		
		return JHtmlSelect::genericlist($rows, $name,$attribs, 'value', 'text', $parent_id);
	}
	static function makeParentChildRelationsForTree(&$inArray, &$outArray, $currentParentId = 0) {
	
		if(!is_array($inArray)) {
			return;
		}
	
		if(!is_array($outArray)) {
			return;
		}
		foreach($inArray as $key => $tuple) {
			if($tuple['parent_id'] == $currentParentId) {
				$tuple['attr']['id'] =  'node_'.$tuple['id'];
				if ($tuple['class'] != null) {
					$tuple['attr']['class'] = $tuple['class'];
				}
				if ($tuple['data'] == null) {
					 $tuple['data'] = $tuple['name'];
				}
				if ($tuple['type'] != null) {
					$tuple['attr']['rel'] = $tuple['type'];
				}
				$tuple['attr']['title'] = $tuple['name'];
				$tuple['children'] = array();				
				AdminTochucHelper::makeParentChildRelationsForTree($inArray, $tuple['children'], $tuple['id']);
				$outArray[] = $tuple;
			}
		}
	}
	static function makeDataForTree(&$inArray, &$outArray, $currentParentId = 0) {
	
		if(!is_array($inArray)) {
			return;
		}
	
		if(!is_array($outArray)) {
			return;
		}
		foreach($inArray as $key => $tuple) {
			if($tuple['parent_id'] == $currentParentId) {
				$tuple['additionalParameters']['children'][] = array();
				AdminTochucHelper::makeDataForTree($inArray, $tuple['additionalParameters']['children'], $tuple['id']);
				$outArray[] = $tuple;
				//unset($inArray[$key]);
			}
		}
	}
	public static function addButton(){
		$task=JRequest::getVar('task');
		$controller=JRequest::getVar('controller');
// 		if ($controller != 'tochucdang') {
			switch ($task)
			{
				case 'add' :
					JToolBarHelper::title('Thêm mới '.JText::_(strtoupper($controller)), 'generic.png' );
				case 'edit':
					JToolBarHelper::title('Hiệu chỉnh '.JText::_(strtoupper($controller)), 'generic.png' );
					JToolBarHelper::save();
					JToolBarHelper::cancel('cancel','Hủy bỏ');
					break;
				default:
// 					JToolBarHelper::title('Quản lý '.JText::_('COM_TOCHUC_'.strtoupper($controller)), 'generic.png' );
					JToolBarHelper::addNew();
// 					JToolBarHelper::editList();
					JToolBarHelper::deleteList('Bạn chắc chắn muốn xóa dữ liệu đã chọn !');
					JToolBarHelper::publish();
					JToolBarHelper::unpublish();
					break;
			}
// 		}
	}
	public static function addSubmenu($vName)
	{
		$title = '';
		$arrayTitle = array(
				'loaihinh'=>'Loại hình đơn vị',
				'thuhang'=>'Thứ hạng đơn vị',
				'cap'=>'Cấp - Tổ chức',
				'goichucvu'=>'Gói chức vụ',
				'chucvu'=>'Chức vụ tổ chức',
				'goiluong'=>'Gói lương',
				'luong'=>'Gói lương tổ chức',
				'goidaotao'=>'Gói đào tạo bồi dưỡng',
				'goihinhthuchuongluong'=>'Gói hình thức hưởng lương',				
				'goibienche'=>'Gói biên chế',
				'biencheloaihinh'=>'Biên chế - Loại hình',
				'linhvuc'=>'Lĩnh vực',
				'tochuc'=>'Tổ chức',
				'tochucdang'=>'Tổ chức Đảng',
				'tochucdoan'=>'Tổ chức đoàn',
				'tochucdoanthe'=>'Tổ chức, đoàn thể khác',
				'tochucdang'=>'Tổ chức Đảng',				
				'capmathe'=>'Tùy chỉnh Cấp mã thẻ'
		);
		$title = $arrayTitle[$vName];
		$title = ($title == null)?'':$title;
		JToolBarHelper::title($title,'generic.png' );
		JHtmlSidebar::addEntry('Loại hình đơn vị','index.php?option=com_tochuc&controller=loaihinh',$vName == 'loaihinh');
		JHtmlSidebar::addEntry('Thứ hạng đơn vị','index.php?option=com_tochuc&controller=thuhang',$vName == 'thuhang');
		JHtmlSidebar::addEntry('Cấp tổ chức','index.php?option=com_tochuc&controller=cap',$vName == 'cap');
		JHtmlSidebar::addEntry('Gói chức vụ','index.php?option=com_tochuc&controller=goichucvu',$vName == 'goichucvu');
		//JHtmlSidebar::addEntry('Tổ chức - Chức vụ','index.php?option=com_tochuc&controller=chucvu',$vName == 'chucvu');
		JHtmlSidebar::addEntry('Gói lương','index.php?option=com_tochuc&controller=goiluong',$vName == 'goiluong');
		JHtmlSidebar::addEntry('Gói đào tạo bồi dưỡng','index.php?option=com_tochuc&controller=goidaotao',$vName == 'goidaotao');
		JHtmlSidebar::addEntry('Gói hình thức hưởng lương','index.php?option=com_tochuc&controller=goihinhthuchuongluong',$vName == 'goihinhthuchuongluong');
		JHtmlSidebar::addEntry('Gói biên chế','index.php?option=com_tochuc&controller=goibienche',$vName == 'goibienche');
// 		JHtmlSidebar::addEntry('Biên chế loại hình','index.php?option=com_tochuc&controller=biencheloaihinh',$vName == 'biencheloaihinh');
		JHtmlSidebar::addEntry('Lĩnh vực','index.php?option=com_tochuc&controller=linhvuc',$vName == 'linhvuc');
		JHtmlSidebar::addEntry('Tổ chức','index.php?option=com_tochuc&controller=tochuc',$vName == 'tochuc');
		JHtmlSidebar::addEntry('Tổ chức đảng','index.php?option=com_tochuc&controller=tochucdang',$vName == 'tochucdang');
		JHtmlSidebar::addEntry('Tổ chức đoàn','index.php?option=com_tochuc&controller=tochucdoan',$vName == 'tochucdoan');
		JHtmlSidebar::addEntry('Tổ chức, đoàn thể khác','index.php?option=com_tochuc&controller=tochucdoanthe',$vName == 'tochucdoanthe');
		//JHtmlSidebar::addEntry('Tùy chỉnh Cấp mã thẻ','index.php?option=com_tochuc&controller=capmathe',$vName == 'capmathe');
		JHtmlSidebar::addEntry('Khen thưởng, kỷ luật','index.php?option=com_tochuc&controller=khenthuongkyluat',$vName == 'khenthuongkyluat');
		//JHtmlSidebar::
		
	
	}
	public static function addSubmenu_bienche($vName)
	{
		$title = '';
		$arrayTitle = array(
				
				'biencheloaihinh'=>'Biên chế - Loại hình'
				
		);
		$title = $arrayTitle[$vName];
		$title = ($title == null)?'':$title;
		JToolBarHelper::title($title,'generic.png' );
		JHtmlSidebar::addEntry('Biên chế loại hình','index.php?option=com_tochuc&controller=biencheloaihinh',$vName == 'biencheloaihinh');
		JHtmlSidebar::addEntry('Hình thức biên chế','index.php?option=com_dmcongtac&controller=hinhthucbienche',$vName == 'hinhthucbienche');
		JHtmlSidebar::addEntry('Thời hạn biên chế hợp đồng','index.php?option=com_dmcongtac&controller=thoihanbienchehopdong',$vName == 'thoihanbienchehopdong');
		JHtmlSidebar::addEntry('Bổ nhiệm/điều động','index.php?option=com_dmcongtac&controller=bonhiemdieudong',$vName == 'bonhiemdieudong');
	
	}
}