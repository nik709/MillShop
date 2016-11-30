<?php
session_start();

function plus($bag)
{
    $bag++;
    $_SESSION['count'] = $bag;
}
?>

<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mill Shop - Women</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>

    <?php
    include('menu.php');
    ?>

    <!-- MAIN BLOCK START -->

    <?php
    include_once("../database/QueryPresenterImpl.php");
    $db = new QueryPresenterImpl();
    $_SESSION['GLOB'] = 302;
    ?>

    <!-- PAGE TILTE -->
    <div class="page-title" id="page-title">Women</div>
    <hr class="delimiter">

    <!-- CRITERIA AND SORTING FORM -->
    <?php
    include ('CriteriaAndSortingForm.php');
    ?>

    <!-- ITEMS -->
    <?php
    echo "<div class='results-of-query' id='results-of-query'>";
    include ("LoadingItemsOnPageAJAX.php");
    echo "</div>";
    ?>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>