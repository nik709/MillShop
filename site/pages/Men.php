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

    <link href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script type="text/javascript" src="scripts/price-slider.js"></script>

    <script>
        var criteriaAndSorting = null;

        function setSize(id, size, isChecked) {
            if(isChecked) {
                if (criteriaAndSorting != null && criteriaAndSorting != "") {
                    criteriaAndSorting += "&" + id + "=" + size;
                }
                else {
                    criteriaAndSorting = id + "=" + size;
                }
            }
            else {
                if (criteriaAndSorting.indexOf(id) != -1) {
                    var string = id + "=" + size;
                    var preIndex = criteriaAndSorting.indexOf(string);
                    var startIndex = preIndex - 1; // Номер символа в строке, с которого начинается значение Color-i
                    if(startIndex != -1) {
                        var oldSize = criteriaAndSorting.substring(startIndex);
                        if (oldSize.indexOf("&") != -1) {
                            string = "&" + string;
                        }
                    }
                    criteriaAndSorting = criteriaAndSorting.replace(string, "");
                }
            }
            //document.getElementById("page-title").innerHTML = criteriaAndSorting;
            process(criteriaAndSorting);
        }

        function setColor(id, color, isChecked) {
            if(isChecked) {
                if (criteriaAndSorting != null && criteriaAndSorting != "") {
                    criteriaAndSorting += "&" + id + "=" + color;
                }
                else {
                    criteriaAndSorting = id + "=" + color;
                }
            }
            else {
                if (criteriaAndSorting.indexOf(id) != -1) {
                    var string = id + "=" + color;
                    var preIndex = criteriaAndSorting.indexOf(string);
                    var startIndex = preIndex - 1; // Номер символа в строке, с которого начинается значение Color-i
                    if(startIndex != -1) {
                        var oldColor = criteriaAndSorting.substring(startIndex);
                        if (oldColor.indexOf("&") != -1) {
                            string = "&" + string;
                        }
                    }
                    criteriaAndSorting = criteriaAndSorting.replace(string, "");
                }
            }
            //document.getElementById("page-title").innerHTML = criteriaAndSorting;
            process(criteriaAndSorting);
        }

        function setSortOption(sortOption) {
            if(criteriaAndSorting != null) {
                if(criteriaAndSorting.indexOf("sortOption") != -1) {
                    var preString = "sortOption=";
                    var preIndex = criteriaAndSorting.indexOf(preString);
                    var searchStartIndex = preIndex + criteriaAndSorting.substring(preIndex).indexOf("=") + 1; // Номер символа в строке, с которого начинается значение сортировки
                    var oldSortOption = criteriaAndSorting.substring(searchStartIndex);
                    preIndex = criteriaAndSorting.indexOf(oldSortOption);
                    if(oldSortOption.indexOf("&") != -1) {
                        var searchEndIndex = preIndex + oldSortOption.indexOf("&");
                        oldSortOption = criteriaAndSorting.substring(searchStartIndex, searchEndIndex);
                    }
                    criteriaAndSorting = criteriaAndSorting.replace(oldSortOption, sortOption);
                }
                else {
                    criteriaAndSorting += "&sortOption=" + sortOption;
                }
            }
            else {
                criteriaAndSorting = "sortOption=" + sortOption;
            }
            //document.getElementById("page-title").innerHTML = criteriaAndSorting;
            process(criteriaAndSorting);
        }

        function process(str) {
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
            xmlhttp.open("GET", "SortingAJAX.php?" + str, true);
            xmlhttp.send();
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

    <div class="page-title" id="page-title">Men</div>
    <hr class="delimiter">

    <!-- CRITERIA AND SORTING FORM -->
    <form name="criteriaAndSortingForm" method="get">
        <!-- CRITERIA -->
        <div id="criteria">
            <div id="criteria-subcategory-form" class="criteria-form">
                <div class="criterion-header">Category</div>
                <?php
                echo "<div id='criterion-subcategories' class='criterion'>";
                //$db->drawColors();
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
            <div id="criteria-price-form" class="criteria-form">
                <div class="criterion-header">Price</div>
                <div id="criterion-price" class="criterion-price">
                    <div class="criterion-price-wrapper">
                        <div id="criteria-slider-price"></div>
                        <div class="criterion-min-max-price-wrapper">
                            <div id="criteria-min-price"></div>
                            <div id="criteria-max-price"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SORTING -->
        <div id="sorting-wrapper">
            <div id="sorting-select">
                <select name="sortOption" id="sortOption" class="simple-select" onchange="setSortOption(this.value)" title="Sort By">
                    <option value="" selected disabled style="display:none;">Sort By</option>
                    <option value="NEWEST">Newest</option>
                    <option value="ASC">Price: Low to High</option>
                    <option value="DESC">Price: High to Low</option>
                </select>
            </div>
        </div>
        <script type="text/javascript">
            document.getElementById('sortOption').value = "<?php echo $_GET['sortOption'];?>";
        </script>
    </form>

    <!-- ITEMS -->

    <?php
    echo "<div class='results-of-query' id='results-of-query'>";
    include_once("SortingAJAX.php");
    echo "</div>";
    ?>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>