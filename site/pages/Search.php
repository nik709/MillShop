
<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 07.11.2016
 * Time: 19:32
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