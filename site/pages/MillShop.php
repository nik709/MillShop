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
<?php
error_reporting(E_ALL & ~E_DEPRECATED);
$link = mysql_connect('localhost:3306/millshop', 'root', 'root');
if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}
echo 'Соединение успешно установлено';
mysql_select_db('MillShop') or die('Не удалось выбрать базу данных');
$query = 'SELECT * FROM SIZES';
$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";
?>
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