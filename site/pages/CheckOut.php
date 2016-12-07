<?php
session_start();
?>
<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Mill Shop</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/Checkout.css">
</head>
<body>
<?php
include('menu.php');
include_once ("../database/SessionControlImpl.php");

if(isset($_SESSION['user-login'])) {
    $sessionControl = new SessionControlImpl();
    $data = $sessionControl->getUserInfo($_SESSION['user-login']);
}
?>

<!-- MAIN BLOCK START -->

<!-- PAGE TILTE -->
<div class="page-title" id="page-title">Shipping Information</div>
<hr class="delimiter">

<form method="post" action="checkout_mess.php">
<div id="log-block">
    <div>
        <div class="checkout-header">Contact Information</div>
        <div class="inputs">
            <input name="first-name" type="text" value ="<?php if(isset($_SESSION['user-login']))echo $data[0];?>" placeholder="First Name" title="First Name" required>
            <input name="last-name" type="text" value ="<?php if(isset($_SESSION['user-login'])) echo $data[1];?>" placeholder="Last Name" title="Last Name" required>
            <input name="e-mail" type="email" value ="<?php if(isset($_SESSION['user-login'])) echo $data[2];?>" placeholder="E-mail" title="E-mail" required>
            <input name="phone" type="text" placeholder="Phone" title="Phone" required>
        </div>
    </div>
    <div>
        <div class="checkout-header">Shipping Address</div>
        <div class="inputs">
            <input name="Country" type="text" placeholder="Country" title="Country" required>
            <input name="City" type="text" placeholder="City" title="City" required>
            <input name="Street" type="text" placeholder="Street" title="Street" required>
            <input class="post-code" name="Apt-Bidg" type="text" placeholder="Apt / Bidg" title="Apt / Bldg" required>
            <input class="post-code" name="PostalCode" type="text" placeholder="Postal Code" title="Postal Code" required>
        </div>
    </div>
    <button class="simple-button place-my-order-button" name="confirm-but">PLACE MY ORDER!</button>
</div>
</form>


<!--  <input type="submit" id="submit" value="ВОЙТИ">-->




<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>
