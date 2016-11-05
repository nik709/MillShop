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

    <!-- MAIN BLOCK START -->

    <h1>Clothes for MEN</h1>

    <!-- SORTING -->
    <form name="sortingForm" method="get">
        <select name="sortOption" id="sortOption" class="simple-select" onchange="sortingForm.submit()">
            <option value="" selected disabled style="display:none;">Sort By</option>
            <option value="ASC">Price: Low to High</option>
            <option value="DESC">Price: High to Low</option>
        </select>
        <input type="text" class="simple-textbox" value="">
        <button class="simple-button">Men</button>
    </form>
    <script type="text/javascript">
        document.getElementById('sortOption').value = "<?php echo $_GET['sortOption'];?>";
    </script>

    <!-- ?php
        $sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : false;
        if ($sortOption) {
            echo htmlentities($_GET['sortOption'], ENT_QUOTES, "UTF-8");
        } else {
            echo "option is required";
        }
    ?> -->

    <?php
    include_once("../database/DBConnection.php");
    $sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;
    $db = new DBConnection();
    $db->openConnection();
    $criteria[0] = "price < 500";
    $db->selectByCriteria($criteria, $sortOption);
    $db->showResult();
    $db->closeConnection();
    ?>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>