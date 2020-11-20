<?php

class CommentRepository extends Repository
{

    function __construct()
    {
        parent::__construct("comment");
    }

    function GetByPublication($publication)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " .$this->table. " WHERE publication = ? ORDER BY date DESC");
        $stmt->bind_param("i", $publication);
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
