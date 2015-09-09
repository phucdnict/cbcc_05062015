<?php
class TochucViewGoibienche extends JViewLegacy
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
    	$model = JModelLegacy::getInstance('Goibienche','TochucModel');
    	$document = JFactory::getDocument();
    	$document->addScript(JURI::root(true).'/media/jui/js/jquery.min.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.validate.min.js');
    	$document->addScript(JURI::root(true).'/media/cbcc/js/jquery/jquery.validate.default.js');
    	$this->items = $model->getAll();
    }   
}
