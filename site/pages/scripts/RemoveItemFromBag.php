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
?>