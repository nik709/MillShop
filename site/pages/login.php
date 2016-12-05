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
        <div>
            <div style="font-size: 30px; margin-bottom: 15px;">SIGN IN</div>
            <fieldset id="inputs">
                <form method="post">
                <p><input id="username" name="login" type="text" placeholder="Login"></p>
                <p><input id="password" name="password" type="password" placeholder="Password"></p>
                <?php
                if(isset($_POST['log-but'])){
                    $session = new SessionControlImpl();
                    $check = $session->checkUser($_POST['login'], md5($_POST['password']));
                    if($check==true){
                        $_SESSION['user-login']=$_POST['login'];
                    }
                    else
                        echo "<div style='font-size: small; color:red'>Login or password is incorrect!</div>";
                }
                ?>
                <button class="simple-button login-button" name="log-but">LOG IN</button>
                </form>
            </fieldset>
        </div>

        <div>
            <div style="font-size: 30px; margin-bottom: 15px;">REGISTER</div>
            <fieldset id="inputs">
                <form method="post">
                    <p><input id="username" name="reg-name1" type="text" placeholder="First Name"></p>
                    <p><input id="username" name="reg-name2" type="text" placeholder="Last Name"></p>
                    <p><input id="username" name="email" type="text" placeholder="E-mail"></p>
                    <p><input id="username" name="reg-login" type="text" placeholder="Login"></p>
                    <p><input id="password" name="reg-password" type="password" placeholder="Password"></p>

                    <?php
                    if(isset($_POST['reg-button'])){
                        $sessionControl = new SessionControlImpl();
                        $test = $sessionControl->addNewUser($_POST['reg-login'],md5($_POST['reg-password']),$_POST['reg-name1'],$_POST['reg-name2'], $_POST['email']);
                        $sessionControl = null;
                    }
                    ?>

                    <button class="simple-button register-button" name="reg-button">REGISTER</button>
                </form>
            </fieldset>
        </div>
    </div>

<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>
