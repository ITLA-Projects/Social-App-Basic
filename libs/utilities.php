<?php

class Utilities{
    function __construct()
    {
        
    }

    function createQuery($entity){

        $entityArr = array_keys(get_object_vars($entity));

        $keys = "";
        $questions = "";

        //get all keys, questions and concatenate
        foreach ($entityArr as $key => $value) {
            if ($key === array_key_first($entityArr)){
                //i dont going to insert the id on this
                //$keys .= "(" . $value . ",";
                //$questions .= "(?,";
                $keys .= "(";
                $questions .= "(";
            }else if($key === array_key_last($entityArr)){
                $keys .= $value . ")";
                $questions .= "?)";
            }else{
                $keys .= $value . ",";
                $questions .= "?,";
            }
        }

        //return the final string
        return "INSERT INTO " . strtolower(get_class($entity)) .  
        " " . $keys . " VALUES " . $questions;
    }

    function updateQuery($entity){
        $entityArr = array_keys(get_object_vars($entity));

        $finalQuery = "";

        //get all keys, questions and concatenate
        foreach ($entityArr as $key => $value) {
            //if is not the first key
            if ($key !== array_key_first($entityArr)){
                //if is not the last key
                if($key !== array_key_last($entityArr)){
                    $finalQuery .= $value . "= ?, ";
                }else{
                    $finalQuery .= $value . "= ? ";
                }
            }
        }

        //return the final string
        return "UPDATE " . strtolower(get_class($entity)) . " SET ".
        $finalQuery . "WHERE id = ?";
    }
}

?>