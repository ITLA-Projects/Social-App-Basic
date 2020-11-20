<?php

class Logout extends Controller
{

    private $auth;

    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();

        $this->auth->Logout();
        header("Location: ".constant('URL'));
        exit();
    }
}
