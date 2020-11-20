<?php

class Repository implements IRepository
{
    public $db;
    public $table;
    public $utilities;

    function __construct($table)
    {
        $this->db = new Database();
        $this->table = $table;
        $this->utilities = new Utilities();
    }

    function GetList()
    {

        $list = array();

        //prepare statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();

        //capture the result
        $rs = $stmt->get_result();


        if ($rs->num_rows === 0) {
            return $list;
        } else {
            //there s information, proceed
            while ($row = $rs->fetch_assoc()) {
                $entity = new $this->table;
                $entity->set($row);

                array_push($list, $entity);
            }
        }

        $stmt->close();
        return $list;
    }

    function GetById($id)
    {
        $entity = new $this->table;

        //prepare statement 
        $stmt = $this->db->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        //capture the result
        $rs = $stmt->get_result();



        if ($rs->num_rows === 0) {
            return null;
        } else {
            //there s information, proceed
            while ($row = $rs->fetch_assoc()) {
                $entity = new $this->table;
                $entity->set($row);
            }
        }

        $stmt->close();
        return $entity;
    }
    function Create($entity)
    {
        try {
            //get a clean array of the entity values
            $arrayValues = array_values(get_object_vars($entity));
            //remove the null id to prevent a fail
            array_shift($arrayValues);

            //execute the statement
            $stmt = $this->db->conn->prepare($this->utilities->createQuery($entity));
            $stmt->bind_param($entity->getKeyTypes("create"), ...$arrayValues);
            $stmt->execute();
            $stmt->close();

            //this code returns the last id inserted, if there is any
            return $this->db->conn->insert_id;
        } catch (\Throwable $th) {
            var_dump($th);
        }
    }
    function Update($entity)
    {
        //get a clean array of the entity values
        $arrayValues = array_values(get_object_vars($entity));
        //move the id value to the last, to prevent a fail
        $onlyId = array_shift($arrayValues);
        //retrieve to the original array
        array_push($arrayValues, $onlyId);

        //execute the statement
        $stmt = $this->db->conn->prepare($this->utilities->updateQuery($entity));
        $stmt->bind_param($entity->getKeyTypes("update"), ...$arrayValues);
        $stmt->execute();
        $stmt->close();
    }
    function Delete($id)
    {
        //prepare statement
        $stmt = $this->db->conn->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
