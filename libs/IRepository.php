<?php

interface IRepository
{
    function GetList();
    function GetById($id);
    function Create($entity);
    function Update($entity);
    function Delete($id);
}

?>