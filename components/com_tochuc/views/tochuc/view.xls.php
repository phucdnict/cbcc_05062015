<?php
/**
 * Author: Phucnh
* Date created: May 25, 2015
* Company: DNICT
*/
defined('_JEXEC') or die();
require 'libraries/phpexcel/Classes/PHPExcel.php';
class TochucViewTochuc extends JViewLegacy
{   
  function __construct()
  { 
  	parent::__construct();
  }
  function display($tpl = null)
   { 
    $objPhpExcel = new PHPExcel();
    $data = JRequest::get('donvi_id');
    $model = Core::model('Tochuc/Tochuc');
	$ketqua = $model->getThongtin('qt.*, ct.name as cachthuc_name','ins_dept_quatrinh qt', array('inner'=>'ins_dept_cachthuc ct on ct.id = qt.cachthuc_id'), 'dept_id = '.$data['donvi_id'], 'hieuluc_ngay DESC');
    $this->assignRef('rows', $ketqua);
    if(is_null($tpl)) $tpl = 'excel';
    parent::display($tpl);
  }
}