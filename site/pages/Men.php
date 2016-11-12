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
    <script>
        function process(str) {
            if(str == "") {
                document.getElementById("results-of-query").innerHTML = "";
            } else {
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                }
                else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("results-of-query").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "SortingAJAX.php?sortOption=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>
    <?php
    include('menu.php');
    ?>

    <!-- MAIN BLOCK START -->

    <?php
    include_once("../database/QueryPresenterImpl.php");
    $db = new QueryPresenterImpl();
    ?>

    <div class="page-title">Men</div>

    <!-- CRITERIA AND SORTING FORM -->
    <form name="criteriaAndSortingForm" method="get">
        <!-- CRITERIA -->
        <div id="criteria">
            <div id="criteria-subcategory-form" class="criteria-form">
                <div class="criterion-header">Category</div>
                <?php
                echo "<div id='criterion-subcategories' class='criterion'>";
                $db->drawColors();
                echo "</div>";
                ?>
            </div>
            <div id="criteria-size-form" class="criteria-form">
                <div class="criterion-header">Size</div>
                <?php
                echo "<div id='criterion-sizes' class='criterion'>";
                $db->drawSizes();
                echo "</div>";
                ?>
            </div>
            <div id="criteria-color-form" class="criteria-form">
                <div class="criterion-header">Color</div>
                <?php
                echo "<div id='criterion-colors' class='criterion'>";
                $db->drawColors();
                echo "</div>";
                ?>
            </div>
        </div>
        <!-- SORTING -->
        <select name="sortOption" id="sortOption" class="simple-select" onchange="process(this.value)" title="Sort By">
            <option value="" selected disabled style="display:none;">Sort By</option>
            <option value="NEWEST">Newest</option>
            <option value="ASC">Price: Low to High</option>
            <option value="DESC">Price: High to Low</option>
        </select>
        <script type="text/javascript">
            document.getElementById('sortOption').value = "<?php echo $_GET['sortOption'];?>";
        </script>
    </form>

    <!-- ITEMS -->

    <?php
    echo "<div class='results-of-query' id='results-of-query'>";
    include_once("SortingAJAX.php");
    /*$sortOption = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;

    $db->setSortOption($sortOption);
    //$criteria[0] = "price > 15";
    //$criteria[1] = "price < 30";
    $db->getItemsByCriteria(null);

    $db->drawItemHolders();
    $db = null;*/
    echo "</div>";
    ?>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>