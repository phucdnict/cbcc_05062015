<?php
class BaocaothongkeControllerBaocaothongkepx extends JControllerLegacy
{
    function __construct(){
        parent::__construct();
    }

    //Default display task
    function display(){
    	JRequest::setVar('view','baocaothongkepx');
        parent::display();
    }


}

