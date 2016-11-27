<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->

<form name="criteriaAndSortingForm" method="get">
    <!-- CRITERIA -->
    <div id="criteria">
        <div id="criteria-subcategory-form" class="criteria-form">
            <div class="criterion-header">Category</div>
            <?php
            echo "<div id='criterion-subcategories' class='criterion' style='width: 216px'>";
            $db->drawSubcategory();
            echo "</div>";
            ?>
        </div>
        <div id="criteria-size-form" class="criteria-form">
            <div class="criterion-header">Size</div>
            <?php
            echo "<div id='criterion-sizes' class='criterion' style='width: 162px'>";
            $db->drawSizes();
            echo "</div>";
            ?>
        </div>
        <div id="criteria-color-form" class="criteria-form">
            <div class="criterion-header">Color</div>
            <?php
            echo "<div id='criterion-colors' class='criterion' style='width: 168px'>";
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
        <?php
        $sortOpt = isset($_GET['sortOption']) ? $_GET['sortOption'] : null;
        if($sortOpt != null) {
            echo "document . getElementById('sortOption') . value = \"$sortOpt\"";
        }
        ?>
    </script>
</form>