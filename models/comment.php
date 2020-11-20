<?php

class Comment{


    public $id;
    public $owner;
    public $publication;
    public $body;
    public $date;

    public function __construct(){
    }

    public function initializeData($id,$owner,$publication,$body,$date){
        $this->id = $id;
        $this->owner = $owner;
        $this->publication = $publication;
        $this->body = $body;
        $this->date = $date;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }


    public function getKeyTypes($query){
        if($query === "create"){
            return "iiss";
        }else if($query === "update"){
            return "iissi";
        }
    }

}

?>