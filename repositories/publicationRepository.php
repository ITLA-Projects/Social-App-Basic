<?php

class PublicationRepository extends Repository
{

    function __construct()
    {
        parent::__construct("publication");
    }

    function GetByOwner($owner)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " .$this->table. " WHERE owner = ? ORDER BY date DESC");
        $stmt->bind_param("i", $owner);
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
