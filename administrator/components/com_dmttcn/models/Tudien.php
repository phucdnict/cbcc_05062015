<?php
class DmttcnModelTudien extends JModelLegacy{
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
			
		$query = 'SELECT * FROM '.$table
		.$where
		.$orderby
		;
		// 		echo $query;exit;
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
		if (!in_array($filter_order, array('id', 'name'))){
			$filter_order = 'tenbang';
		}
	
		if (!in_array(strtoupper($filter_order_Dir), array('ASC', 'DESC'))) {
			$filter_order_Dir = '';
		}
	
		if ($filter_order != 'tenbang'){
			$orderby 	= ' ORDER BY  name '.$filter_order_Dir;
		} else {
			$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir.',name ';
		}
	
		return $orderby;
	}
	
	public function listDanhsach($table){
		if (empty($this->_data)){
			$query = $this->_buildQuery($table);//echo $query;exit;
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}
		return $this->_data;
	}
	
	public function getEditItem($table, $tenbang, $tentruong){
		$db = JFactory::getDbo();
		$query = 'SELECT * FROM '.$table.' WHERE tenbang ="'.$tenbang.'" and tentruong = "'.$tentruong.'"';
		$db->setQuery($query);
		return $db->loadAssocList();
	}
	
	public function storeData(){
		$app	= JFactory::getApplication();
		$flag = true;
		$data = JRequest::get('post');
		$db= JFactory::getDbo();
		$query = $db->getQuery(true);
		$tenbangcu = $data['tenbangcu'];
		$tentruongcu = $data['tentruongcu'];
		$fields = array(
				$db->quoteName('tenbang').'='.$db->quote($data['tenbang']),
				$db->quoteName('tentruong').'='.$db->quote($data['tentruong']),
				$db->quoteName('name').'='.$db->quote($data['name']),
				$db->quoteName('name_edit').'='.$db->quote($data['name_edit']),
				$db->quoteName('name_detail').'='.$db->quote($data['name_detail']),
				$db->quoteName('status').'='.$db->quote($data['status']),
		);
		if ($tenbangcu != '' && $tentruongcu != ''){
			$conditions = array(
					$db->quoteName('tenbang').'='.$db->quote($tenbangcu),
					$db->quoteName('tentruong').'='.$db->quote($tentruongcu)
			);
			$query->update($db->quoteName('tudien'))->set($fields)->where($conditions);
		}
		else{
			$query->insert($db->quoteName('tudien'));
			$query->set($fields);
		}
		$db->setQuery($query);
		if (!$db->query()) {
			return false;
		} else {
			return true;
		}
	}
	
	public function remove($table, $tenbang, $tentruong){
		$db = JFactory::getDbo();
		if($tenbang=='' || $tentruong==''){
			return false;
		}
		$sql="DELETE FROM ".$table." WHERE tenbang = '$tenbang' AND tentruong = '$tentruong'";
		$db->setQuery($sql);
		if (! $db->query()){
			return false;
		}
		return true;
	}
	public function publish($table,  $tenbang, $tentruong){
		$db = JFactory::getDbo();
		$sql="UPDATE ".$table." SET status = 1 WHERE tenbang = '$tenbang' AND tentruong = '$tentruong'";
		$db->setQuery($sql);
		if (! $db->query()){
			return false;
		}
		return true;
	}
	
	public function unpublish($table,  $tenbang, $tentruong){
		$db = JFactory::getDbo();
		$sql="UPDATE ".$table." SET status = 0 WHERE tenbang = '$tenbang' AND tentruong = '$tentruong'";
		$db->setQuery($sql);
		if (! $db->query()){
			return false;
		}
		return true;
	}
}