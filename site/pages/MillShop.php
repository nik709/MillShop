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

<div id="wrapping-block">
<<<<<<< HEAD
<div id="menu-block">
    <?php
    include('menu.html');
    ?>
</div>

<div id="main-block">
    <div class="margin-wrapper">
    <h1>Welcome to Mill Shop!</h1>
    <form>
        <button id="clickme">Click Me!</button>
    </form>

    <?php
    include_once("../database/DBConnection.php");
    $db = new DBConnection();
    $db->openConnection();
    $db->setQuery("select * from items");
    $db->execueQuery();
    $db->showResult();
    $db->closeConnection();
    ?>
=======
    <div id="menu-block">
        <?php
        include('menu.html');
        ?>
    </div>
>>>>>>> 52597ef5e710657912216b498acf091bc77392fe

    <div id="main-block">
        <div class="margin-wrapper">
            <div id="banners-block">
                <div id="main-banner"><img src="../resources/images/banners/banner_40001.jpg"></div>
                <div id="shop-banners-block">
                    <div id="banner-shop-men"><a href="Men.php"><img src="../resources/images/banners/banner_40002.jpg"></a></div>
                    <div id="banner-shop-women"><a href="Women.php"><img src="../resources/images/banners/banner_40003.jpg"></a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="footer-block">
    <?php
    include('footer.html');
    ?>
</div>


</body>
</html>