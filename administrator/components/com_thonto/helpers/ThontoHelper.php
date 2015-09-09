	<?php
class AdminThontoHelper{
	public static function addButton(){
		$task=JRequest::getVar('task');
		$controller=JRequest::getVar('controller');
			switch ($task)
			{
				case 'add' :
					JToolBarHelper::title('Thêm mới '.JText::_(strtoupper($controller)), 'generic.png' );
				case 'edit':
					JToolBarHelper::title('Hiệu chỉnh '.JText::_(strtoupper($controller)), 'generic.png' );
					JToolBarHelper::save();
					JToolBarHelper::cancel('cancel','Hủy bỏ');
					break;
				case 'configdot':
					JToolBarHelper::title('Cấu hình đợt - kiến nghị '.JText::_(strtoupper($controller)), 'generic.png' );
					JToolBarHelper::custom( 'saveConfigdot', 'save', '', 'Lưu và thoát', false, false );
					JToolBarHelper::cancel('cancel','Hủy bỏ');
					break;
				default:
					JToolBarHelper::addNew();
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
				'tochuc'=>'Thiết lập Cây đơn vị',
				'chibo'=>'Chi bộ',
				'loaihinhtochuc'=>'Loại hình tổ chức',
				'chucvu'=>'Chức vụ',
				'hinhthuckhenthuongkyluat'=>'Hình thức khen thưởng, kỷ luật',
				'loaibhyt'=>'Loại bảo hiểm y tế',
				'kiennghi'=>'Kiến nghị',
				'dotbaocao'=>'Đợt báo cáo',
				'noidunghop'=>'Nội dung họp',
		);
		$title = $arrayTitle[$vName];
		$title = ($title == null)?'':$title;
		JToolBarHelper::title($title,'generic.png' );
		JHtmlSidebar::addEntry('Thiết lập Cây đơn vị','index.php?option=com_thonto&controller=tochuc',$vName == 'tochuc');
		JHtmlSidebar::addEntry('Chi bộ','index.php?option=com_thonto&controller=chibo',$vName == 'chibo');
		JHtmlSidebar::addEntry('Loại hình tổ chức','index.php?option=com_thonto&controller=loaihinhtochuc',$vName == 'loaihinhtochuc');
		JHtmlSidebar::addEntry('Chức vụ','index.php?option=com_thonto&controller=chucvu',$vName == 'chucvu');
		JHtmlSidebar::addEntry('Hình thức khen thưởng, kỷ luật','index.php?option=com_thonto&controller=hinhthuckhenthuongkyluat',$vName == 'hinhthuckhenthuongkyluat');
		JHtmlSidebar::addEntry('Loại bảo hiểm y tế','index.php?option=com_thonto&controller=loaibhyt',$vName == 'loaibhyt');
		JHtmlSidebar::addEntry('Kiến nghị','index.php?option=com_thonto&controller=kiennghi',$vName == 'kiennghi');
		JHtmlSidebar::addEntry('Nội dung họp','index.php?option=com_thonto&controller=noidunghop',$vName == 'noidunghop');
		JHtmlSidebar::addEntry('Đợt báo cáo','index.php?option=com_thonto&controller=dotbaocao',$vName == 'dotbaocao');
	}
	static public function collect($table,$colums,$where = null,$order = null,$isCache = true){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
		->select($colums)
		->from($table);
		if ($order != null && is_string($order)) {
			$query->order($order);
		}
		if ($where != null && is_array($where)) {
			$query->where($where);
		}
		// 		echo  $query->__toString();
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	public static function selectBox($value,$attrs,$table,$colums,$where = null,$order = null){
		if (count($colums) >= 2) {
	
			if (isset($table) && is_array($table)) {
				$rows = $table;
			}else{
				$rows = AdminThontoHelper::collect($table, $colums, $where);
			}
			if (is_array($attrs)) {
				$controlName = $attrs['name'];
				if ($controlName) {
					$controlAttrs = " ng-model=\"".$controlName."\"";
				}
				unset($attrs['name']);
				unset($attrs['value']);
				foreach ($attrs as $key=>$val){
					if (is_array($val)) {
						$controlAttrs .=" ".$key.'="'.implode(" ", $val).'"';
					}else{
						$controlAttrs .=" ".$key.'="'.$val.'"';
					}
				}
			}else{
				$controlAttrs = $attrs;
			}
			if (isset($attrs['hasEmpty']) && $attrs['hasEmpty'] == true) {
				$option = array("$colums[0]"=>'',"$colums[1]"=>'');
				array_unshift($rows, $option);
			}
	
			return JHTML::_('select.genericlist',$rows,$controlName, $controlAttrs, $colums[0],$colums[1],$value);
		}
		return '';
	}
}