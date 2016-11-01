<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>500</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>

<div id="wrapping-block">
    <div id="menu-block">
        <?php
        include('menu.html');
        ?>
    </div>

    <div id="main-block">
        <div id = "error-title">500</div>
        <div id = "error-text">INTERNAL SERVER ERROR</div>

        <a onclick="history.back()"> <button id="clickme">Back</button></a>


    </div>
</div>
<div id="footer-block">
    <?php
    include('footer.html');
    ?>
</div>

</body>
</html>