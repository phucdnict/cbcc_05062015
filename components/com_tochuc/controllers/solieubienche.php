<?php
/**
 * Author: Phucnh
 * Date created: Apr 3, 2015
 * Company: DNICT
 * Công chức tập tự bổ nhiệm ngạch
 */
class TochucControllerSolieubienche extends JControllerLegacy {
  function __construct($config = array()) {
		parent::__construct ( $config );
		$user = & JFactory::getUser ();
    	if ($user->id == null) {
			//var_dump(JRequest::getVar('format'));exit;
			if (JRequest::getVar('format') == 'raw') {
				echo '<script> window.location.href="index.php?option=com_users&view=login"; </script>';
				exit;
			}else{
				$this->setRedirect ( "index.php?option=com_users&view=login" );
			}
		}
	}
	function display() {         
 		$document    =& JFactory::getDocument();
        $viewName    = JRequest::getVar( 'view', 'solieubienche');
        // Get some vars for the view
        $viewLayout = JRequest::getVar( 'layout', 'default');
        $viewType   = $document->getType();    
        // Get the view
        $view =& $this->getView( $viewName, $viewType);
        // Set the layout
        $view->setLayout($viewLayout);		
        $view->display(); 	
        $task = JRequest::getVar('task');
        switch($task){
        	case 'savebienche':
        		$this->savebienche();
        		break;
        }
	}
	function savebienche(){
		$formData = JRequest::get('post');
		$values = array();
		parse_str($formData['form_solieubienche'], $values);
		$model = Core::model('Tochuc/Solieubienche');
		if ($model->removebienche($values['id_donvi'])){
			if($model->savebienche($values)){
				Core::PrintJson(true);
			}else Core::PrintJson(false);
		}else Core::PrintJson(false);
		die;
	}
}
?>