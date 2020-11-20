<?php

class FriendRepository extends Repository
{

    function __construct()
    {
        parent::__construct("friend");
    }


    function GetByUserOne($userOne)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " . $this->table . " WHERE userOne = ?");
        $stmt->bind_param("i", $userOne);
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

    function GetByUserOneAndUserTwo($userOne,$userTwo)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " . $this->table . " WHERE userOne = ? and userTwo = ?");
        $stmt->bind_param("ii", $userOne,$userTwo);
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

    function DeleteByUserOneAndUserTwo($userOne, $userTwo)
    {
        //prepare statement
        $stmt = $this->db->conn->prepare("DELETE FROM " . $this->table . " WHERE userOne = ? and userTwo = ?");
        $stmt->bind_param("ii", $userOne, $userTwo);
        $stmt->execute();
    }
}
