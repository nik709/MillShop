<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mill Shop - Men</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/Men.css">
</head>
<body>
    <?php
    include('menu.html');
    ?>

    <h1>Clothes for MEN</h1>
    <form>
        <input type="text" class="simple-textbox" value="">
        <button class="simple-button">Men</button>
    </form>

    <?php
    include_once("../database/DBConnection.php");
    $db = new DBConnection();
    $db->openConnection();
    $criteria[0] = "price < 500";
    $db->selectByCriteria($criteria);
    $db->showResult();
    $db->closeConnection();
    ?>

    <?php
    include('footer.html');
    ?>
</body>
</html>