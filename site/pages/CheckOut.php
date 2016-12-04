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
    <title>Mill Shop</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/Login.css">
</head>
<body>
<?php
include('menu.php');
include_once ("../database/SessionControlImpl.php");

if(isset($_SESSION['user-login'])) {
    $sessionControl = new SessionControlImpl();
    $test = $sessionControl->getUserInfo($_SESSION['user-login']);
}
?>

<!-- MAIN BLOCK START -->

<div id="log-block">
    <form method="post" action="checkout_mess.php" >
    <div>
        <div style="font-size: 30px; margin-bottom: 15px; ">CHECKOUT</div>
        <div style="font-size: 18px; margin-bottom: 15px;">PERSONAL DATA</div>
        <fieldset id="inputs">
                <p><input name="first-name" type="text"  value ="<?php if(isset($_SESSION['user-login']))echo $test[0];?>" placeholder="First Name"></p>
                <p><input name="last-name" type="text" value ="<?php if(isset($_SESSION['user-login'])) echo $test[1];?>" placeholder="Last Name"></p>
                <p><input name="e-mail" type="text" value ="<?php if(isset($_SESSION['user-login'])) echo $test[2];?>" placeholder="E-mail"></p>
                <p><input name="phone" type="text" placeholder="Phone"></p>

        </fieldset>
    </div>

    <div>
        <fieldset id="inputs">
                <div  style="font-size: 30px; margin-bottom: 15px; color: white"> Empty Line </div>
                <div style="font-size: 18px; margin-bottom: 15px;">ADDRESS</div>
                <p><input name="Country" type="text" placeholder="Country"></p>
                <p><input name="City" type="text" placeholder="City"></p>
                <p><input name="Street" type="text" placeholder="Street"></p>
                <p>
                    <input class="post-code" name="Apt-Bidg" type="text" placeholder="Apt/Bidg">
                    <input class="post-code" name="Postal Code" type="text" placeholder="Postal Code">
                </p>

                <button class="simple-button login-button" name="confirm-but" >CONFIRM</button>
        </fieldset>
    </div>

    </form>
</div>



<!--  <input type="submit" id="submit" value="ВОЙТИ">-->




<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>
