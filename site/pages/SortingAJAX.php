<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

include_once("../database/QueryPresenterImpl.php");
$db = new QueryPresenterImpl();

$sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;

$criteria = null;
for($i = 0; $i < 10; $i++) {
    $color = isset($_GET['Color-' . $i]) ? $_GET['Color-' . $i] : null;
    if($color != null) {
        $criteria[$i] = "color = $color";
    }
}

$db->setSortOption($sortOption);
$db->getItemsByCriteria($criteria);
$db->drawItemHolders();

$db = null;

?>