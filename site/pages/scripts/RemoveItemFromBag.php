<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */
session_start();

$id = $_GET['valueId'];
$_SESSION['count'] -= $_SESSION['quant'][$id];

$j = 0;
$sizeArr = count($_SESSION['item']) - 1;
for($i = $id; $i < $sizeArr; $i++) {
    $_SESSION['item'][$i] = $_SESSION['item'][$i + 1];
    $_SESSION['size'][$i] = $_SESSION['size'][$i + 1];
    $_SESSION['quant'][$i] = $_SESSION['quant'][$i + 1];
}
unset($_SESSION['item'][count($_SESSION['item']) - 1]);
unset($_SESSION['size'][count($_SESSION['size']) - 1]);
unset($_SESSION['quant'][count($_SESSION['quant']) - 1]);
?>