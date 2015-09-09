<?php
class TochucViewBiencheloaihinh extends JViewLegacy
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
        AdminTochucHelper::addSubmenu_bienche($vName);
        $this->sidebar = JHtmlSidebar::render();
        parent::display($tpl);
    }
    private function _initDefaultPage(){
    	//JToolBarHelper::addNew('edit');
    	//JToolBarHelper::cancel();    	
     	$document = JFactory::getDocument();
    	$document->addScript(JURI::root(true).'/media/jui/js/jquery.min.js');
    	//$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.cookie.js');
    	//$document->addScript(JURI::root(true).'/media/cbcc/js/jstree/jquery.jstree.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
    	$model = JModelLegacy::getInstance('Biencheloaihinh','TochucModel');
    	$this->items = $model->getAll();
     	
    }   
}
