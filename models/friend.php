<?php

class Friend{


    public $id;
    public $userOne;
    public $userTwo;
    public $status;

    public function __construct(){
    }

    public function initializeData($id,$userOne,$userTwo,$status){
        $this->id = $id;
        $this->userOne = $userOne;
        $this->userTwo = $userTwo;
        $this->status = $status;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getKeyTypes($query){
        if($query === "create"){
            return "iii";
        }else if($query === "update"){
            return "iiii";
        }
    }
}

?>