<?php

class User{


    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;

    public function __construct(){

    }

    public function initializeData($id,$username,$password,$firstname,$lastname,$email,$phone){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getKeyTypes($query){
        if($query === "create"){
            return "ssssss";
        }else if($query === "update"){
            return "ssssssi";
        }
    }

}

?>