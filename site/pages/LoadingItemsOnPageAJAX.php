<?php
$s = session_status();
if ($s == 1)
    session_start();
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

include_once("../database/QueryPresenterImpl.php");
$db = new QueryPresenterImpl();

$sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;

$criteria = null;
$k=0;
for($i = 0; $i < 30; $i++) {
    $category = isset($_GET['Category-' . $i]) ? $_GET['Category-' . $i] : null;
    if($category != null) {
        $criteria[$k] = "category = $category";
        $k++;
    }
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

$minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : null;
if($minPrice != null) {
    $criteria[$k] = "price > $minPrice";
}
$maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : null;
if($minPrice != null) {
    $criteria[$k + 1] = "price < $maxPrice";
}
//echo "$minPrice <br> $maxPrice <br>";

$db->setGlobalCategory($_SESSION['GLOB']);
$db->setSortOption($sortOption);
$db->getItemsByCriteria($criteria);
$db->drawItemHolders();

?>