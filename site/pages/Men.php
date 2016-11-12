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
    <title>Mill Shop - Men</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
    <?php
    include('menu.php');
    ?>

    <!-- MAIN BLOCK START -->

    <div class="page-title">Men</div>

    <!-- CRITERIA -->
    <form name="criteriaAndSortingForm" method="get">
        <div id="criteria">
            <div id="criteria-size-form">
                <div class="criterion-header">Size</div>
                <?php
                echo "<div id='criterion-sizes'>";
                for ($i = 0; $i < 5; $i++) {
                    echo "<div class='simple-checkbox-wrapper'><input type=\"checkbox\" class='simple-checkbox' id='size-" . $i . "' name=\"Size-" . $i . "\" value=\"M\" 
                        onchange=\"criteriaAndSortingForm.submit()\"";
                    if (isset($_GET["Size-" . $i])) {
                        echo "checked='checked'";
                    }
                    echo "/><label for='size-" . $i . "'>M</label></div><Br>";
                }
                echo "</div>";
                ?>
            </div>
            <div id="criteria-color-form">
                <div class="criterion-header">Color</div>
                <?php
                echo "<div id='criterion-colors'>";
                for ($i = 0; $i < 8; $i++) {
                    echo "<div class='simple-checkbox-wrapper'><input type=\"checkbox\" class='simple-checkbox' id='color-" . $i . "' name=\"Color-" . $i . "\" value=\"102\" 
                        onchange=\"criteriaAndSortingForm.submit()\"";
                    if(isset($_GET["Color-". $i])) {
                        echo "checked='checked'";
                    }
                    echo "><label for='color-" . $i . "'>Navy " . $i . "</label></div><Br>";
                }
                echo "</div>";
                ?>
            </div>
        </div>
        <!-- SORTING -->
        <select name="sortOption" id="sortOption" class="simple-select" onchange="criteriaAndSortingForm.submit()" title="Sort By">
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

    include_once("../database/QueryPresenterImpl.php");
    $sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;
    $db = new QueryPresenterImpl();
    $db->setSortOption($sortOption);
    $criteria[0] = "price > 15";
    $criteria[1] = "price < 30";
    $db->getItemsByCriteria($criteria);
    $db->drawItemHolders();
    $db->drawSizes();
    $db = null;
    ?>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>