<?php
/**
 * @ Author: Phucnh
 * @ Date: Aug 11, 2015
 * @ File_name: chibo.php
 */
defined('_JEXEC') or die('Restricted access');
class ThontoModelDotbaocao extends JModelList{
	var $_data = null;
	var $_total = null;
	var $_pagination = null;
	public function __construct(){
		parent::__construct();
		$this->mainframe = JFactory::getApplication();
		$this->option = JRequest::getWord('option');
		
		$limit = $this->mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $this->mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $this->mainframe->getUserStateFromRequest( $this->option.'.limitstart', 'limitstart', 0, 'int' );
		
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
		
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
	}
	
	public function getTotal($table){
		if (empty($this->_total)){
			$query = $this->_buildQuery($table);
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
	
	public function getPagination($table){
		if (empty($this->_pagination)){
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal($table), $this->getState('limitstart'), $this->getState('limit') );
		}
		return $this->_pagination;
	}
	
	public function _buildQuery($table){
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();
		$query = 'select * from  '.$table.$where.$orderby;
		return $query;
	}
	
	public function _buildContentWhere(){
		$this->mainframe = JFactory::getApplication();
		$this->option = JRequest::getWord('option');
			
		$status = $this->mainframe->getUserStateFromRequest( $this->option.'status','status', '', 'string' );
		$filter_order = $this->mainframe->getUserStateFromRequest( $this->option.'filter_order', 'filter_order', 'name', 'cmd' );
		$filter_order_Dir = $this->mainframe->getUserStateFromRequest( $this->option.'filter_order_Dir', 'filter_order_Dir', '', 'word' );
		
		$search	= $this->mainframe->getUserStateFromRequest( $this->option.'search', 'search', '', 'string');
		if (strpos($search, '"') !== false) {
			$search = str_replace(array('=', '<'), '', $search);
		}
		$search = JString::strtolower($search);
		$location = JString::strtolower($location);
		$where = array();
		if ($search) {
			$where[] = 'LOWER(name) LIKE '.$this->_db->Quote( '%'.$search.'%');
		}
		if($status != ''){
			$where[] = 'status = '.(int) $status;
		}
		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );
	
		return $where;
	}
	
	public function _buildContentOrderBy(){
		$this->mainframe = JFactory::getApplication();
		$this->option = JRequest::getWord('option');
		$filter_order		= $this->mainframe->getUserStateFromRequest( $this->option.'filter_order','filter_order','','name','cmd' );
		$filter_order_Dir	= $this->mainframe->getUserStateFromRequest( $this->option.'filter_order_Dir','filter_order_Dir',	'',	'word' );
		if (!in_array($filter_order, array('trangthai', 'tendot'))){
			$filter_order = 'trangthai';
		}
	
		if (!in_array(strtoupper($filter_order_Dir), array('ASC', 'DESC'))) {
			$filter_order_Dir = '';
		}
	
		if ($filter_order != 'trangthai'){
			$orderby 	= ' ORDER BY  ten '.$filter_order_Dir;
		} else {
			$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.',tendot ';
		}
		return $orderby;
	}
	
	public function listDanhsach($table){
		if (empty($this->_data)){
			$query = $this->_buildQuery($table);
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	
	public function getEditItem($table, $id){
		$db = JFactory::getDbo();
		$query = 'SELECT * FROM '.$table.' WHERE id ='.$id;
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	public function saveFkKiennghi(){
		$data = JRequest::get('post');
		$dotbaocao_id = $data['id'];
		$kiennghi = $data['kiennghi'];
		$flag=false;
		for ($i=0; $i<count($kiennghi);$i++){
			$db = JFactory::getDbo();
			$query = 'INSERT INTO thonto_kiennghitheodot(dmkiennghi_id,dotbaocao_id) VALUES ('.$kiennghi[$i].','.$dotbaocao_id.')' ;
			$db->setQuery($query);
			 if($db->query())
			 	$flag=true;
			 else {$flag=false;break;}
		}
		return $flag;
	}
	public function delFkKiennghi($doibaocao_id){
		$db = JFactory::getDbo();
		$query = 'DELETE FROM thonto_kiennghitheodot WHERE dotbaocao_id ='.$doibaocao_id ;
		$db->setQuery($query);
		return $db->query();
	}
	public function saveFkNoidunghop(){
		$data = JRequest::get('post');
		$dotbaocao_id = $data['id'];
		$noidunghop = $data['noidunghop'];
		$flag=false;
		for ($i=0; $i<count($noidunghop);$i++){
			$db = JFactory::getDbo();
			$query = 'INSERT INTO thonto_noidunghoptheodot(dmnoidunghop_id,dotbaocao_id) VALUES ('.$noidunghop[$i].','.$dotbaocao_id.')' ;
			$db->setQuery($query);
			 if($db->query())
			 	$flag=true;
			 else {$flag=false;break;}
		}
		return $flag;
	}
	public function delFkNoidunghop($doibaocao_id){
		$db = JFactory::getDbo();
		$query = 'DELETE FROM thonto_noidunghoptheodot WHERE dotbaocao_id ='.$doibaocao_id ;
		$db->setQuery($query);
		return $db->query();
	}
	public function getKiennghi(){
		$db = JFactory::getDbo();
		$query = 'SELECT * FROM thonto_danhmuckiennghi WHERE trangthai = 1 order by sapxep';
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	public function getnoidunghop(){
		$db = JFactory::getDbo();
		$query = 'SELECT * FROM thonto_danhmucnoidunghop WHERE trangthai = 1 order by sapxep';
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	public function getFk_Dot_Kiennghi($id){
		$db = JFactory::getDbo();
		$query = 'SELECT dmkiennghi_id FROM thonto_kiennghitheodot WHERE dotbaocao_id ='.$id;
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	public function getFk_Dot_Noidunghop($id){
		$db = JFactory::getDbo();
		$query = 'SELECT dmnoidunghop_id FROM thonto_noidunghoptheodot WHERE dotbaocao_id ='.$id;
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	
	public function storeData(){
		$flag = true;
		$data = JRequest::get('post');
		$db= JFactory::getDbo();
		$object = new stdClass();
		$object->tendot = $data['tendot'];
		$object->nam = $data['nam'];
		$object->trangthai = $data['trangthai'];
		if((int)$data['id'] == 0){
			$flag = $flag&&$db->insertObject($data['dbtable'], $object);
		}
		else{
			$object->id = (int)$data['id'];
			$flag = $flag&&$db->updateObject($data['dbtable'], $object,'id');
		}
		$iddot_inserted = $db->insertid();
// 		lấy id kiến nghị của đợt đã chọn để kế thừa -- chỉ dùng trong thêm mới
		if($data['thuake_dot']>0)
			$arr = $this->getFk_Dot_Kiennghi($data['thuake_dot']);
		for($i=0; $i<count($arr); $i++)
			$this->themmoiFkKiennghi($arr[$i]['dmkiennghi_id'], $iddot_inserted);
		
// 		lấy id Nội dung họp của đợt đã chọn để kế thừa -- chỉ dùng trong thêm mới
		if($data['thuake_noidunghop']>0)
			$arr_noidunghop = $this->getFk_Dot_Noidunghop($data['thuake_noidunghop']);
		for($i=0; $i<count($arr_noidunghop); $i++)
			$this->themmoiFkNoidunghop($arr_noidunghop[$i]['dmnoidunghop_id'], $iddot_inserted);
		return $flag;
	}
	public function themmoiFkKiennghi($kiennghi, $dot){
		$db = JFactory::getDbo();
		$query = 'INSERT INTO thonto_kiennghitheodot(dmkiennghi_id,dotbaocao_id) VALUES ('.$kiennghi.','.$dot.')' ;
		$db->setQuery($query);
		return ($db->query());
	}
	public function themmoiFkNoidunghop($noidunghop, $dot){
		$db = JFactory::getDbo();
		$query = 'INSERT INTO thonto_noidunghoptheodot(dmnoidunghop_id,dotbaocao_id) VALUES ('.$noidunghop.','.$dot.')' ;
		$db->setQuery($query);
		return ($db->query());
	}
	public function remove($table, $cid){
		$db = JFactory::getDbo();
		if(!is_array($cid)||count($cid)==0){
			return false;
		}
		$ids = implode(",", $cid);
		$sql="DELETE FROM ".$table." WHERE id IN ($ids)";
		$db->setQuery($sql);
		if (! $db->query()){
			return false;
		}
		return true;
	}
	
	public function publish($table, $cid){
		$db = JFactory::getDbo();
		if(!is_array($cid)||count($cid)==0){
			return false;
		}
		$ids = implode(",", $cid);
		$sql="UPDATE ".$table." SET trangthai = 1 WHERE id IN ($ids)";
		$db->setQuery($sql);
		if (! $db->query()){
			return false;
		}
		return true;
	}
	
	public function unpublish($table, $cid){
		$db = JFactory::getDbo();
		if(!is_array($cid)||count($cid)==0){
			return false;
		}
		$ids = implode(",", $cid);
		$sql="UPDATE ".$table." SET trangthai = 0 WHERE id IN ($ids)";
		$db->setQuery($sql);
		if (! $db->query()){
			return false;
		}
		return true;
	}
}