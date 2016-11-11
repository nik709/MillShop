<?php
session_start();
?>
<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internal server error</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
    <?php
    include('menuu.php');
    ?>

    <!-- MAIN BLOCK START -->

    <div class="error-title">500</div>
    <div class="error-text">INTERNAL SERVER ERROR</div>
    <a onclick="history.back()"><button class="simple-button">Back</button></a>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>