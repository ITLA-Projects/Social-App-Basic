<?php

class ErrorHandler extends Controller{

    function __construct()
    {
        parent::__construct();
        $this->view->message = "Error...";
        $this->view->render('error/index');
    }

}

?>