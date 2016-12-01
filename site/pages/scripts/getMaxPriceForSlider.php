<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */
session_start();

include_once "../../database/QueryPresenterImpl.php";
$dataObj = new QueryPresenterImpl();
$dataObj->setGlobalCategory($_SESSION['GLOB']);
echo json_encode(ceil($dataObj->getMaxPrice()));
?>