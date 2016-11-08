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
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
    <?php
    include('menu.html');
    ?>

    <!-- MAIN BLOCK START -->

    <div class="page-title">Men</div>

    <!-- CRITERIA -->
    <div id="criteria">
        <div id="criteria-size-form">
            <div class="criterion-header">Size</div>
            <form name="sizeCriterion" method="get">
                <?php
                echo "<div id='criterion-sizes'>";
                for ($i = 0; $i < 5; $i++) {
                    echo "<div class='simple-checkbox-wrapper'><input type=\"checkbox\" class='simple-checkbox' id='size-" . $i . "' name=\"Size-" . $i . "\" value=\"M\" 
                        onchange=\"sizeCriterion.submit()\"";
                    if (isset($_GET["Size-" . $i])) {
                        echo "checked='checked'";
                    }
                    echo "/><label for='size-" . $i . "'>M</label></div><Br>";
                }
                echo "</div>";
                ?>
            </form>
        </div>

        <div id="criteria-color-form">
            <div class="criterion-header">Color</div>
            <form name="colorCriterion" method="get">
                <?php
                echo "<div id='criterion-colors'>";
                for ($i = 0; $i < 8; $i++) {
                    echo "<div class='simple-checkbox-wrapper'><input type=\"checkbox\" class='simple-checkbox' id='color-" . $i . "' name=\"Color-" . $i . "\" value=\"102\" 
                        onchange=\"colorCriterion.submit()\"";
                    if(isset($_GET["Color-". $i])) {
                        echo "checked='checked'";
                    }
                    echo "><label for='color-" . $i . "'>Navy " . $i . "</label></div><Br>";
                }
                echo "</div>";
                ?>
            </form>
        </div>
    </div>

    <!-- SORTING -->
    <form name="sortingForm" method="get">
        <select name="sortOption" id="sortOption" class="simple-select" onchange="sortingForm.submit()" title="Sort By">
            <option value="" selected disabled style="display:none;">Sort By</option>
            <option value="NEWEST">Newest</option>
            <option value="ASC">Price: Low to High</option>
            <option value="DESC">Price: High to Low</option>
        </select>
    </form>
    <script type="text/javascript">
        document.getElementById('sortOption').value = "<?php echo $_GET['sortOption'];?>";
    </script>

    <!-- ITEMS -->
    <?php
    include_once("../database/DBConnection.php");
    $sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;
    $db = new DBConnection();
    $db->openConnection();
    $criteria[0] = "price < 500";
    $db->setSortOption($sortOption);
    $db->selectByCriteria($criteria);
    $db->showResult();
    $db->closeConnection();
    ?>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>