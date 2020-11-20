<?php

class Login extends Controller
{

    private $auth;

    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        //empty on every call
        $this->view->logginMessage = "";
    }

    function try()
    {
        //lets collect the info
        if (isset($_POST['username']) && isset($_POST['password'])) {

            //if is logged successfully, create a session, if not just returns false
            $isLogged = $this->auth->Login($_POST['username'], $_POST['password']);

            //logged successfully
            if ($isLogged) {
                header("Location: ".constant('URL'));
                exit();
            } else {
                //wrong credentials
                $this->view->logginMessage = "wrong credentials, try again";
                $this->render();
            }
        } else {
            //you did not fill the info, bring some message
            $this->view->logginMessage = "you need to fill the fields first";
            $this->render();
        }
    }

    function render()
    {
        //before render, you need to check the authentication

        //does a user exists? go back home
        if ($this->auth->checkAuthentication()) {
            header("Location: ".constant('URL'));
            exit();
        } else {
            //it does not? then you can render this
            $this->view->render('login/index');
        }
    }
}
