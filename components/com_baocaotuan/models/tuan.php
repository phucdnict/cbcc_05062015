<?php
/**
 * Author: Phucnh
 * Date created: May 12, 2015
 * Company: DNICT
 */
class BaocaotuanModelTuan extends JModelLegacy{
	/**
	 * combobox với một danh mục đơn giản
	 * @param string $table
	 * @param string $field
	 * @param string $where
	 * @param string $order
	 * @param string $text
	 * @param string $code
	 * @param string $name
	 * @param string $selected
	 * @param string $idname
	 * @param string $class
	 * @param string $attrArray
	 */
	public function getCbo($table,$field,$where=null,$order,$text,$code,$name,$selected=null,$idname=null,$class=null,$attrArray=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query	->select(array($field))
		->from($table);
		if($where != null || $where != "")
			$query->where($where);
		$query->order($order);
		$db->setQuery($query);
		$tmp = $db->loadObjectList();
		$data=array();
		array_push($data, array('value','text' => $text));
		for($i=0;$i<count($tmp);$i++){
			$attr=array();
			if(isset($attrArray) && is_array($attrArray))
			foreach ($attrArray as $k=>$v){
				$attr+=array($k=>$tmp[$i]->$v);
			}
			if (!isset($attr) && !is_array($attr))
				array_push($data, array('value' => $tmp[$i]->$code,'text' => $tmp[$i]->$name));
			else {
				array_push($data, array('value' => $tmp[$i]->$code,'text' => $tmp[$i]->$name,'attr'=>$attr));
			}
		}
		$options = array(
				'id' => $idname,
				'list.attr' => array(
						'class'=>$class,
				),
				'option.key'=>'value',
				'option.text'=>'text',
				'option.attr'=>'attr',
				'list.select'=>$selected
		);
		return $result = JHtmlSelect::genericlist($data,$idname,$options);
	}
	/**
	 * Hàm lưu quá trình kỷ luật
	 * @param unknown $formData
	 * @return boolean
	 */
	public function savetuan($formData){
		$db =  JFactory::getDbo();
		try {
			$query = $db->getQuery(true);
			if (isset($formData['hai'])) $hai = 1;
			if (isset($formData['ba'])) $ba = 1;
			if (isset($formData['tu'])) $tu = 1;
			if (isset($formData['nam'])) $nam = 1;
			if (isset($formData['sau'])) $sau = 1;
			if (isset($formData['bay'])) $bay = 1;
			$fields = array(
				$db->quoteName('user_id').'='.$db->quote($formData['user_id']),
				$db->quoteName('congviec').'='.$db->quote($formData['congviec']),
				$db->quoteName('maduan').'='.$db->quote($formData['maduan']),
				$db->quoteName('tenduan').'='.$db->quote($formData['tenduan']),
				$db->quoteName('batdau').'='.$db->quote($this->strDateVntoMySql($formData['batdau'])),
				$db->quoteName('ketthuc').'='.$db->quote($this->strDateVntoMySql($formData['ketthuc'])),
				$db->quoteName('hoanthanh').'='.$db->quote($formData['hoanthanh']),
				$db->quoteName('ykiendexuat').'='.$db->quote($formData['ykiendexuat']),
				$db->quoteName('hai').'='.$db->quote($hai),
				$db->quoteName('ba').'='.$db->quote($ba),
				$db->quoteName('tu').'='.$db->quote($tu),
				$db->quoteName('nam').'='.$db->quote($nam),
				$db->quoteName('sau').'='.$db->quote($sau),
				$db->quoteName('bay').'='.$db->quote($bay),
			);
			if(isset($formData['trangthai'])){ 
				array_push($fields, $db->quoteName('trangthai').'= 1'); 
			}else{ 
				array_push($fields, $db->quoteName('trangthai').'= 0');
			}
			if(isset($formData['dophuctap'])){ 
				array_push($fields, $db->quoteName('dophuctap').'= 1'); 
			}else{ 
				array_push($fields, $db->quoteName('dophuctap').'= 0');
			}
			if (isset($formData['id']) && (int)$formData['id']>0){
				$conditions = array(
						$db->quoteName('id').'='.$db->quote($formData['id'])
				);
				$query->update($db->quoteName('zxbaocao'))->set($fields)->where($conditions);
			}
			else{
				$query->insert($db->quoteName('zxbaocao'));
				$query->set($fields);
			}
			$db->setQuery($query);
		 	$db->query();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	/**
	 * Xóa quá trình báo cáo
	 * @param int $id
	 * @return boolean
	 */
	public function delquatrinh($id){
		try{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$conditions = array(
					$db->quoteName('id').' IN ('.$id.')'
			);
			$query->delete($db->quoteName('zxbaocao'));
			$query->where($conditions);
			$db->setQuery($query);
			$db->query();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	function uploadtuan($name=null,$tmp_name=null){
		require 'libraries\phpexcel\Classes\PHPExcel.php';
		require_once 'libraries\phpexcel\Classes\PHPExcel\IOFactory.php';
		$arr = array();
		$user_import = jFactory::getUser()->id;
		$md5 = md5(rand(0,999));
		$hash = substr($md5, 15, 10);
		$filename	= 	$hash.date('mdY').''.($this->regexFileUpload($_FILES['file']['name'], true));
		move_uploaded_file($_FILES['file']['tmp_name'], $filename); // tải file lên server
		$objPHPExcel = PHPExcel_IOFactory::load ($filename);
		$objPHPExcel->setActiveSheetIndex(0); // lấy sheet đầu tiên
		
		//  	$objPHPExcel->setActiveSheetIndexByName('DSCBCC'); // lấy sheet với tên DSCBCC
		$highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn(); // số cột lớn nhất = tên ABCDE
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn ); // số cột lớn nhất
		$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); // số hàng lớn nhất
		for($row = 9; $row <= ($highestRow) ; ++ $row) {
			for($col = 2; $col < ($highestColumnIndex); ++ $col) {
				$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow ( $col, $row );
				$val = $cell->getValue ();
				if ($col==2 && (int)$val <=0){
					break;
				}
				else 
					$arr[$row][$col]= $val;
			}
		}
		unlink($filename); // xóa file khỏi hệ thống
		$j=0;
		for ($i = 9; $i<(count($arr)+9); $i++){
			$ar[$j] = $arr[$i];
			$j++; 
		}
		$arrKq = $this->saveImportbaocao($ar);
		return $arrKq;
	}
	/**
	 * Lưu thông tin dữ liệu import báo cáo tuần
	 * @param array $arr
	 * @return boolean
	 */
	function saveImportbaocao($arrData){
		$db = JFactory::getDbo();
		$array = array();
		for($i=0; $i<(count($arrData));$i++){
				$query = $db->getQuery(true);
				$dophuctap = $arrData[$i][5] =='X' ? '1':'0'; 
				$hoanthanh = str_replace('%', '', $arrData[$i][8]);
				$duan = $this->getThongtin('id', 'zxduan', null, 'tenduan = "'.$arrData[$i][4].'"');
				$maduan = $duan[0]->id;
				$hai 		= $arrData[$i][9] =='X' ? '1':'0';
				$ba 		= $arrData[$i][10] =='X' ? '1':'0';
				$tu 		= $arrData[$i][11] =='X' ? '1':'0';
				$nam 	= $arrData[$i][12] =='X' ? '1':'0';
				$sau 	= $arrData[$i][13] =='X' ? '1':'0';
				$bay 	= $arrData[$i][14] =='X' ? '1':'0';
					$fields = array(
							$db->quoteName('congviec').'='.$db->quote($arrData[$i][3]),
							$db->quoteName('trangthai').'= 1',
							$db->quoteName('tenduan').'='.$db->quote($arrData[$i][4]),
							$db->quoteName('dophuctap').'='.$db->quote($dophuctap),
							$db->quoteName('batdau').'=STR_TO_DATE( '.$db->quote($arrData[$i][6]).',"%d/%m/%Y")',
							$db->quoteName('ketthuc').'=STR_TO_DATE( '.$db->quote($arrData[$i][7]).',"%d/%m/%Y")',
							$db->quoteName('hoanthanh').'='.$db->quote($hoanthanh),
							$db->quoteName('maduan').'='.$db->quote($maduan),
							$db->quoteName('hai').'='.$db->quote($hai),
							$db->quoteName('ba').'='.$db->quote($ba),
							$db->quoteName('tu').'='.$db->quote($tu),
							$db->quoteName('nam').'='.$db->quote($nam),
							$db->quoteName('sau').'='.$db->quote($sau),
							$db->quoteName('bay').'='.$db->quote($bay),
							$db->quoteName('ykiendexuat').'='.$db->quote($arrData[$i][15]),
							$db->quoteName('ngayimport').'='.$db->quote(date('Y-m-d')),
							$db->quoteName('user_id').'='.$db->quote(JFactory::getUser()->id),
					);
					if ((isset($arrData[$i]['id'])) && ($arrData[$i]['id']>0)){
						$conditions = array(
								$db->quoteName('id').'='.$db->quote($arrData[$i]['id'])
						);
						$query->update($db->quoteName('zxbaocao'))->set($fields)->where($conditions);
					}else{
						$query->insert($db->quoteName('zxbaocao'));
						$query->set($fields);
					}
					$query .=';';
					$db->setQuery($query);
					$db->execute();
		}
	}
	/**
	 *
	 * @param string $cs chuỗi ký tự tiếng việt
	 * @param string $tolower true: viết thường, fasle: giữ nguyên
	 * @return string|mixed
	 */
	function regexFileUpload($cs, $tolower = false)
	{
		/*Mảng chứa tất cả ký tự có dấu trong Tiếng Việt*/
		$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
				"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
				"ế","ệ","ể","ễ",
				"ì","í","ị","ỉ","ĩ",
				"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
				"ờ","ớ","ợ","ở","ỡ",
				"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
				"ỳ","ý","ỵ","ỷ","ỹ",
				"đ",
				"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
				"Ằ","Ắ","Ặ","Ẳ","Ẵ",
				"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
				"Ì","Í","Ị","Ỉ","Ĩ",
				"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
				"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
				"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
				"Đ"," ");
	
		/*Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên*/
		$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a",
				"a","a","a","a","a","a",
				"e","e","e","e","e","e","e","e","e","e","e",
				"i","i","i","i","i",
				"o","o","o","o","o","o","o","o","o","o","o","o",
				"o","o","o","o","o",
				"u","u","u","u","u","u","u","u","u","u","u",
				"y","y","y","y","y",
				"d",
				"a","a","a","a","a","a","a","a","a","a","a","a",
				"a","a","a","a","a",
				"e","e","e","e","e","e","e","e","e","e","e",
				"i","i","i","i","i",
				"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
				"u","u","u","u","u","u","u","u","u","u","u",
				"y","y","y","y","y",
				"d","_");
		if ($tolower) {
			return strtolower(str_replace($marTViet,$marKoDau,$cs));
		}
		return str_replace($marTViet,$marKoDau,$cs);
	}
	/**
	 * Lưu thông tin làm thêm giờ
	 * @param unknown $formData
	 * @return boolean
	 */
	public function savelamthemgio($formData){
		$db =  JFactory::getDbo(); 
		try {
			$query = $db->getQuery(true);
			$fields = array(
					$db->quoteName('user_id').'='.$db->quote($formData['user_id']),
					$db->quoteName('congvieclamthem').'='.$db->quote(trim($formData['congvieclamthem'])),
					$db->quoteName('ngaylamthem').'='.$db->quote($this->strDateVntoMySql($formData['ngaylamthem'])),
					$db->quoteName('timebatdau').'='.$db->quote($formData['timebatdau']),
					$db->quoteName('timeketthuc').'='.$db->quote($formData['timeketthuc']),
					$db->quoteName('thoigian').'='.$db->quote($formData['thoigian']),
			);
			if (isset($formData['id']) && (int)$formData['id']>0){
				$conditions = array(
						$db->quoteName('id').'='.$db->quote($formData['id'])
				);
				$query->update($db->quoteName('zxlamthemgio'))->set($fields)->where($conditions);
			}
			else{
				$query->insert($db->quoteName('zxlamthemgio'));
				$query->set($fields);
			}
			$db->setQuery($query);
			$db->query();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	/**
	 * Xóa làm thêm giờ
	 * @param int $id
	 * @return boolean
	 */
	public function dellamthemgio($id){
		try{
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$conditions = array(
					$db->quoteName('id').' IN ('.$id.')'
			);
			$query->delete($db->quoteName('zxlamthemgio'));
			$query->where($conditions);
			$db->setQuery($query);
			$db->query();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	/**
	 * Hàm lấy thông tin từ 1 table, có thể join thêm bảng và điều kiện, trả về 1 list đối tượng
	 * @param array|string $field
	 * @param string $table
	 * @param array $arrJoin array(key => value)
	 * @param array $where array(where1, where2)
	 * @param string $order
	 * @return objectlist
	 */
	function getThongtin($field, $table, $arrJoin=null, $where=null, $order=null){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($field)
		->from($table);
		if (count($arrJoin)>0)
			foreach ($arrJoin as $key=>$val){
				$query->join($key, $val);
			}
		for($i=0;$i<count($where);$i++)
			if ($where[$i]!='')
				$query->where($where);
		if($order!=null)$query->order($order);
// 		echo $query;die;
		$db->setQuery($query);
		return $db->loadObjectList();
	}
	/**
	 *
	 * @param string $dateVN
	 */
	static public function strDateVntoMySql($dateVN){
		if (empty($dateVN)) {
			return '';
		}
		$dateVN = explode('/', $dateVN);
		return $dateVN[2].'-'.$dateVN[1].'-'.$dateVN[0];
	}
}