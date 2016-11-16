<?php
session_start();
if (!isset($_SESSION['count']))
    $_SESSION['count'] = 0;
?>
<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item's Name - Mill Shop</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
<?php
include('menu.php');
?>

<!-- MAIN BLOCK START -->

<?php
include_once ('../database/QueryPresenterImpl.php');

$id = isset($_GET['ID']) ? $_GET['ID'] : null;
$db = new QueryPresenterImpl();
$db->getItemById($id);
$db->printItemInformation();
?>

<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>