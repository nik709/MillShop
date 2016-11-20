<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

interface SessionControl
{
    public function addNewUser($login, $password, $firstName, $lastName);

    public function checkUser($login, $password);

}