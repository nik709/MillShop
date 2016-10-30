<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mill Shop - Kids</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/Kids.css">
</head>
<body>

<div id="wrapping-block">
<div id="menu-block">
    <?php
    include('menu.html');
    ?>
</div>

<div id="main-block">
    <h1>Clothes for KIDS</h1>
    <form>
        <button id="clickme">Kids</button>
    </form>

    <?php
    error_reporting(E_ALL & ~E_DEPRECATED);
    $link = mysqli_connect('localhost:3306', 'root', 'root', 'millshop');
    if (!$link) {
        die('Ошибка соединения: ' . mysqli_error($link));
    }
    echo 'Соединение успешно установлено';
    mysqli_select_db($link, 'MillShop') or die('Не удалось выбрать базу данных');
    $query = 'SELECT * FROM COLORS';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' .mysqli_error($link));
    echo "<table>\n";
    while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    ?>

</div>
</div>

<div id="footer-block">
    <?php
    include('footer.html');
    ?>
</div>

</body>
</html>