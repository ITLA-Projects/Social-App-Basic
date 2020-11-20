<?php

class Auth
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function Login($user, $password)
    {
        //check session
        $this->checkSession();

        $stmt = $this->db->conn->prepare("SELECT * FROM user WHERE username = ? and password = ?");
        $stmt->bind_param("ss", $user, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return false;
        } else {
            $entity = $result->fetch_object();

            $user = new User();

            $user->id = $entity->id;
            $user->username = $entity->username;
            $user->firstname = $entity->firstname;
            $user->lastname = $entity->lastname;
            $user->email = $entity->email;
            $user->phone = $entity->phone;

            $_SESSION['user'] = json_encode($user);
            return true;
        }
    }

    function Logout()
    {
        //check session
        $this->checkSession();

        try {
            session_destroy();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * check if there is a user authenticated
     */
    function checkAuthentication()
    {
        //check session
        $this->checkSession();

        //does user variable exists?
        if (isset($_SESSION['user'])) {


            //does have any value
            if ($_SESSION['user'] == null) {
                $_SESSION['messageAuth'] = "You must Login first";

                return false;
            } else {
                return true;
            }
        } else {
            $_SESSION['messageAuth'] = "You must Login first";

            return false;
        }
    }

    function retrieveUser()
    {
        //check session
        $this->checkSession();

        //you can only retrieve the user if you are already logged
        if ($this->checkAuthentication()) {
            return json_decode($_SESSION['user']);
        } else {
            //but to prevent errors, just retrieve an empty user
            $user = new User();
            $user->initializeData(0, "", "", "", "", "", "");
            return $user;
        }
    }

    private function checkSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
