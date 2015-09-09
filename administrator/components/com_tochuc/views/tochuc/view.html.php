<?php
class TochucViewTochuc extends JViewLegacy
{
    /**
     * @since  1.5
     */
    public function display($tpl = null)
    {    	
    	$task = JFactory::getApplication()->input->get('task');
    	$task = ($task == null)?'default':strtoupper($task);        
        $this->setLayout(strtolower($task));        
        $vName = JRequest::getString('view');
        switch($task){
            default:
                $this->_initDefaultPage();
                break;
        }
        AdminTochucHelper::addSubmenu($vName);
        $this->sidebar = JHtmlSidebar::render();
        parent::display($tpl);
    }
    private function _initDefaultPage(){
    	//JToolBarHelper::addNew('edit');
    	//JToolBarHelper::cancel();
    	$document = JFactory::getDocument();
    	//     	//$document->addCustomTag('<link href="'.JURI::base(true).'/media/cbcc/js/jquery/select2/select2.css" rel="stylesheet" />');
    	$document->addCustomTag('<link href="'.JURI::root(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
    	//     	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.dataTables.min.js');
    	//     	$document->addScript(JURI::base(true).'/media/cbcc/js/jquery/jquery.dataTables.bootstrap.js');
    	$document->addScript(JURI::root(true).'/media/jui/js/jquery.min.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.cookie.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jstree/jquery.jstree.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/fuelux/fuelux.tree.min.js');
    }   
}
