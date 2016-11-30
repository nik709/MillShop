<?php
session_start();
if (!isset($_SESSION['count']))
    $_SESSION['count'] = 0;

if (!isset($_SESSION['item']))
    $_SESSION['item'] = array();

if (!isset($_SESSION['quant']))
    $_SESSION['quant'] = array();

if (!isset($_SESSION['size']))
    $_SESSION['size'] = array();

?>
<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bag - Mill Shop</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
<?php
include('menu.php');
?>

<!-- MAIN BLOCK START -->

Bag is under construction.
Please wait...

<form method="post">
    <?php
    if(isset($_POST['button'])) {
        session_destroy();
        header("Location: bag.php") ;
    }

    if(isset($_SESSION['user-login']) && isset($_SESSION['user-pass'])) {
        echo(" User's login: " . $_SESSION['user-login'].'<br />');
        echo(" User's password: " . $_SESSION['user-pass'].'<br />');
    }

    foreach ($_SESSION['item'] as $value) {
        printf($value.'<br/>');
    }
    foreach ($_SESSION['quant'] as $value) {
        printf($value.'<br/>');
    }
    foreach ($_SESSION['size'] as $value) {
        printf($value.'<br/>');
    }
    ?>
    <button class="simple-button" name="button">LOG OUT</button>
</form>

<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>