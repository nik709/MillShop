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

<!-- 
$conn = oci_connect('system', 'root', '//localhost:1521/XE');
if ($conn){
    echo 'connection is correct';
}
 -->

<div id="menu-block">
    <?php
    include('menu.html');
    ?>
</div>

<div id="main-block">
    <h1>Welcome to Mill Shop!</h1>
    <form>
        <button id="clickme">Click Me!</button>
    </form>
</div>

<div id="footer-block">
    <?php
    include('footer.html');
    ?>
</div>

</body>
</html>