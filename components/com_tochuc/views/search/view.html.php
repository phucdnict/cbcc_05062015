<?php
class TochucViewSearch extends JViewLegacy
{
    /**
     * @since  1.5
     */
    public function display($tpl = null)
    {   
    	$task = JFactory::getApplication()->input->get('task');
    	$task = ($task == null)?'default':strtoupper($task);        
        $this->setLayout(strtolower($task));
        $this->assignRef('Itemid', JFactory::getApplication()->input->get('Itemid'));
        switch($task){          
            default:
                $this->_initDefaultPage($task);
                break;
        }                
        parent::display($tpl);
    }
    private function _initDefaultPage($task){
    	$document = JFactory::getDocument();
    	$document->addStyleSheet(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/css/dataTables.tableTools.css');
    	$document->addScript( JURI::root(true) . '/media/cbcc/js/bootstrap.tab.ajax.js' );    	
    	$document->addScript( JURI::root(true) . '/media/cbcc/js/jquery.maskedinput.min.js' );    	
    	$document->addScript( JURI::root(true) . '/media/cbcc/js/jquery/chosen.jquery.min.js' );    	
    	$document->addStyleSheet(JURI::root(true).'/media/cbcc/js/jquery/select2/select2.css');
    	$document->addStyleSheet(JURI::root(true).'/media/cbcc/js/jquery/select2/select2-bootstrap.css');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/select2/select2.min.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/select2/select2_locale_vi.js');
    	$document->addScript(JURI::base(true).'/media/cbcc/js/jstree/jquery.jstree.js');
		$document->addStyleSheet(JURI::root(true).'/media/cbcc/js/jquery/select2/select2-bootstrap.css');
		$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/jquery.dataTables.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.bootstrap.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/dataTables.tableTools.min.js');
		$document->addScript(JURI::base(true).'/media/cbcc/js/dataTables-1.10.0/datatables.default.config.js');
    	$tableStatus = Core::table('Tochuc/InsStatus');
    	$tableType =  Core::table('Tochuc/InsType');
    	$tableInsDeptCachthuc = Core::table('Tochuc/InsDeptCachthuc');
    	$tableInsDeptLoaihinh = Core::table('Tochuc/InsDeptLoaihinh');
    	$model = Core::model('Tochuc/InsDept');
    	$status = $tableStatus->findAll();
    	$type_created = $tableInsDeptCachthuc->findAllCachThucThanhLap();
    	$types = $tableType->findAll();
    	$ins_loaihinhs = $tableInsDeptLoaihinh->findAllParent();
    	// Thông tin thêm
    	$goibienche	=	$model->getCbo('bc_goibienche ', 'id, name', ' active=1','id asc', '--Chọn tất cả--', 'id', 'name', null, 'goibienche', 'chosen');
    	$goidaotao			=	$model->getCbo('cb_goidaotaoboiduong ', 'id, name', ' status=1','id asc', '--Chọn tất cả--', 'id', 'name', null, 'goidaotaoboiduong', 'chosen');
    	$goihinhthuchuongluong		=	$model->getCbo('cb_goihinhthuchuongluong ', 'id, name', ' status=1','id asc', '--Chọn tất cả--', 'id', 'name', null, 'goihinhthuchuongluong', 'chosen');
    	$goiluong		=	$model->getCbo('cb_goiluong ', 'id,CONCAT(REPEAT("--", level), name) as name', ' level!=0 AND status=1','lft asc', '--Chọn tất cả--', 'id', 'name', null, 'goiluong', 'chosen');
    	$goichucvu	=	$model->getCbo('cb_goichucvu ', 'id, CONCAT( REPEAT ("--", level), name) as name', ' level!=0 AND status=1','lft asc', '--Chọn tất cả--', 'id', 'name', null, 'goichucvu', 'chosen');
    	$linhvuc	=	$model->getThongtin('id,name,level','cb_type_linhvuc',null, array('type=2'), 'lft asc');
    	// Lịch sử
    	$cachthuc_id	=	$model->getCbo('ins_dept_cachthuc ', 'id, name', null  ,'id asc', '--Chọn tất cả--', 'id', 'name', null, 'cachthuc_id', 'chosen');
    	$this->assignRef('cachthuc_id', $cachthuc_id);
    	$this->assignRef('linhvuc', $linhvuc);
    	$this->assignRef('goichucvu', $goichucvu);
    	$this->assignRef('goiluong', $goiluong);
    	$this->assignRef('goibienche', $goibienche);
    	$this->assignRef('goidaotao', $goidaotao);
    	$this->assignRef('goihinhthuchuongluong', $goihinhthuchuongluong);
    	$this->assignRef('status',$status);
    	$this->assignRef('type_created',$type_created);
    	$this->assignRef('types',$types);
    	$this->assignRef('ins_loaihinhs',$ins_loaihinhs);
    }  
 
}
