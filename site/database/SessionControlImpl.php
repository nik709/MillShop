<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

include_once ("SessionControl.php");
include_once ("DBConnection.php");
class SessionControlImpl extends DBConnection  implements SessionControl
{
    function __construct(){
        parent::__construct();
    }

    function __destruct(){
        parent::__destruct();
    }

    public function addNewUser($login, $password, $firstName, $lastName)
    {
        $query = "INSERT INTO users (LOGIN, PASSWORD, FIRSTNAME, LASTNAME) VALUES ('$login', '$password', '$firstName', '$lastName')";
        parent::setQuery($query);
        parent::executeQuery("ADD NEW USER");
    }

    public function checkUser($login, $password)
    {
        $chech = false;

        return $chech;
    }


}