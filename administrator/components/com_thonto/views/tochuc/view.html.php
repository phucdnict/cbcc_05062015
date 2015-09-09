<?php
class ThontoViewTochuc extends JViewLegacy
{
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
        AdminThontoHelper::addSubmenu($vName);
        $this->sidebar = JHtmlSidebar::render();
        parent::display($tpl);
    }
    private function _initDefaultPage(){
    	$document = JFactory::getDocument();
    	$document->addCustomTag('<link href="'.JURI::root(true).'/media/cbcc/js/jstree/themes/default/style.css" rel="stylesheet" />');
    	$document->addScript(JURI::root(true).'/media/jui/js/jquery.min.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.cookie.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jstree/jquery.jstree.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/fuelux/fuelux.tree.min.js');
    }   
}
