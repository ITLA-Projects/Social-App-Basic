<?php

class Signup extends Controller
{

    private $repo;
    private $auth;
    private $userRepo;

    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->repo = new Repository("user");
        $this->userRepo = new UserRepository();

        $this->view->message = "";
        $this->view->usernameMessage = "";
        $this->view->passwordMessage = "";
    }

    function create()
    {
        $this->view->message = "";
        $this->view->usernameMessage = "";
        $this->view->passwordMessage = "";

        if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {

            $pass = true;

            //test the username
            if (count($this->userRepo->GetByUsername($_POST['username'])) > 0) {
                $this->view->usernameMessage = "This username is taken, use other";
                $pass = false;
            }

            //test the password
            if ($_POST['password'] !== $_POST['confirmPassword']) {
                $this->view->passwordMessage = "Password and confirm password must be the same";
                $pass = false;
            }

            //CHECK SO
            if ($pass) {

                $user = new User();

                $user->initializeData(
                    0,
                    $_POST['username'],
                    $_POST['password'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $_POST['email'],
                    $_POST['phone'],
                );

                $this->repo->Create($user);


                //if everything is fine, redirect to login
                header("Location: " . constant('URL') . "login");
                exit();
            } else {
                $this->render();
            }
        } else {
            $this->view->message = "You need to complete all the fields before";
            $pass = false;
        }
    }

    function render()
    {
        //before render, you need to check the authentication

        //does a user exists? go back home
        if ($this->auth->checkAuthentication()) {
            header("Location: " . constant('URL'));
            exit();
        } else {
            //it does not? then you can render this
            $this->view->render('signup/index');
        }
    }
}
