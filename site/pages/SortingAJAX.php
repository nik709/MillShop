<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

include_once("../database/QueryPresenterImpl.php");
$db = new QueryPresenterImpl();

$sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;

$criteria = null;
$k=0;
for($i = 0; $i < 20; $i++) {
    $color = isset($_GET['Color-' . $i]) ? $_GET['Color-' . $i] : null;
    if($color != null) {
        $criteria[$k] = "color = $color";
        $k++;
    }
    $size = isset($_GET['Size-' . $i]) ? $_GET['Size-' . $i] : null;
    if($size != null) {
        $criteria[$k] = "size = $size";
        $k++;
    }
}

$db->setSortOption($sortOption);
$db->getItemsByCriteria($criteria);
$db->drawItemHolders();
$db = null;

?>