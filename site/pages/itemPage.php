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

Здеся будет товар :/

<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>