<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

include_once "../../database/QueryPresenterImpl.php";
$dataObj = new QueryPresenterImpl();
echo json_encode(floor($dataObj->getMinPrice()));

?>