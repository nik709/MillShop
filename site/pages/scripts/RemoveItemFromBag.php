<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */
session_start();
$id = $_GET['valueId'];
$_SESSION['count'] -= $_SESSION['quant'][$id];
unset($_SESSION['item'][$id]);
unset($_SESSION['size'][$id]);
unset($_SESSION['quant'][$id]);
/*$_SESSION['item'] = array_diff($_SESSION['item'], $_SESSION['item'][$id]);
$_SESSION['size'] = array_diff($_SESSION['size'], $_SESSION['size'][$id]);
$_SESSION['quant'] = array_diff($_SESSION['quant'], $_SESSION['quant'][$id]);*/
?>