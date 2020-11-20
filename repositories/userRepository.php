<?php

class UserRepository extends Repository
{

    function __construct()
    {
        parent::__construct("user");
    }

    function GetByUsername($username)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " .$this->table. " WHERE username = ?");
        $stmt->bind_param("s", $username);
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

}
