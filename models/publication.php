<?php

class Publication{


    public $id;
    public $owner;
    public $title;
    public $body;
    public $date;

    public function __construct(){
    }

    public function initializeData($id,$owner,$title,$body,$date){
        $this->id = $id;
        $this->owner = $owner;
        $this->title = $title;
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
            return "isss";
        }else if($query === "update"){
            return "isssi";
        }
    }

}

?>