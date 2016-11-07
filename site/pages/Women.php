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
    <title>Mill Shop - Women</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/Women.css">
</head>
<body>

    <?php
    include('menu.html');

    ?>

    <!-- MAIN BLOCK START -->

    <h1>Clothes for WOMEN</h1>
    <form method="post">
        <?php
        if(isset($_POST['button'])) {
           plus($_SESSION['count']);
        }
        printf($_SESSION['count'].'<br />');

        if(isset($_SESSION['user-login']) && isset($_SESSION['user-pass'])) {
            echo(" User's login: " . $_SESSION['user-login'].'<br />');
            echo(" User's password: " . $_SESSION['user-pass'].'<br />');
        }
        ?>
        <button class="simple-button" name="button">Women</button>

    </form>


    <!-- MAIN BLOCK END -->

    <?php
    include('footer.html');
    ?>
</body>
</html>