<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

$search = isset($_GET['search']) ? $_GET['search'] : null;
if (($search)!=null){
    echo "$search";
}
else{
    echo '<script type="text/javascript">';
    echo 'window.location.href = "../pages/MillShop.php"';
    echo '</script>';
}

?>