<?php
class TochucTableTochucLinhvuc extends JTable
{
	var $linhvuc_id = null;
	var $ins_dept_id = null;
	function __construct(&$db)
	{
		parent::__construct( 'ins_dept_linhvuc', array('linhvuc_id','ins_dept_id'), $db );
	}
}