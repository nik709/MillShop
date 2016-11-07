<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mill Shop</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
    <?php
    include('menu.html');
    ?>

    <script type="text/javascript">
        document.getElementsByName("search").value = "<?php echo $_GET['search'];?>";
    </script>

    <?php
    $search = isset($_GET['search']) ? $_GET['search'] : "QWE";
    echo "$search";
    ?>

    <!-- MAIN BLOCK START -->

    <div id="banners-block">
        <div id="main-banner"><img src="../resources/images/banners/banner_40001.jpg"></div>
        <div id="shop-banners-block">
            <div id="banner-shop-men"><a href="Men.php"><img src="../resources/images/banners/banner_40002.jpg"></a></div>
            <div id="banner-shop-women"><a href="Women.php"><img src="../resources/images/banners/banner_40003.jpg"></a></div>
        </div>
    </div>

    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>