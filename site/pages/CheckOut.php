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
?>

<!-- MAIN BLOCK START -->

<div id="log-block">
    <form method="post">
    <div>
        <div style="font-size: 30px; margin-bottom: 15px; ">CHECKOUT</div>
        <div style="font-size: 18px; margin-bottom: 15px;">PERSONAL DATA</div>
        <fieldset id="inputs">
                <p><input id="username" name="first-name" type="text" placeholder="First Name"></p>
                <p><input id="password" name="last-name" type="text" placeholder="Last Name"></p>
                <p><input id="E-mail" name="e-mail" type="text" placeholder="E-mail"></p>
                <p><input id="Phone" name="phone" type="text" placeholder="Phone"></p>

        </fieldset>
    </div>

    <div>
        <fieldset id="inputs">

                <div  style="font-size: 30px; margin-bottom: 15px; color: white"> Empty Line </div>
                <div style="font-size: 18px; margin-bottom: 15px;">ADDRESS</div>
                <p><input id="username" name="Country" type="text" placeholder="Country"></p>
                <p><input id="password" name="City" type="password" placeholder="City"></p>
                <p><input id="E-mail" name="Index" type="text" placeholder="Index"></p>
                <p><input id="Phone" name="Street" type="password" placeholder="Street"></p>

                <?php
                if(isset($_POST['order-but'])){

                }
                ?>
                <button class="simple-button login-button" name="log-but">Order</button>

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
