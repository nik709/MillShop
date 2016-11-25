<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mill Shop - Kids</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
    <?php
    session_start();
    include('menu.php');
    ?>

    <!-- MAIN BLOCK START -->

    <h1>Clothes for KIDS</h1>

    <form name="ggg">
        <input type="number" class="simple-textbox simple-spinner" name="yyy" value="1" min="1" max="10">
        <input type="submit" class="simple-button">
    </form>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>