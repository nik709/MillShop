<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

include_once("../database/QueryPresenterImpl.php");
$db = new QueryPresenterImpl();

$sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;

$criteria[0] = "color = red";
$db->setSortOption($sortOption);
$db->getItemsByCriteria($criteria);
$db->drawItemHolders();

$db = null;

?>