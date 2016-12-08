<?php
session_start();
include ('SessionInit.php');
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
    <div id="left-column" class="column-ms">
        <div class="page-title">Sign In</div>
        <hr class="delimiter">
        <form method="post">
            <div class="inputs">
                <input id="login-sign-in" name="login" type="text" placeholder="Login" title="Login" required>
                <input id="password-sign-in" name="password" type="password" placeholder="Password" title="Password" required>
                <?php
                if(isset($_POST['log-but'])){
                    $session = new SessionControlImpl();
                    $check = $session->checkUser($_POST['login'], password_hash($_POST['password'],PASSWORD_BCRYPT));
                    if($check==true){
                        $_SESSION['user-login']=$_POST['login'];
                    }
                    else
                        echo "<div style='font-size: small; color:red'>Login or password is incorrect!</div>";
                }
                echo "<button class=\"simple-button login-button\" name=\"log-but\">LOG IN</button>";
                ?>
            </div>
        </form>
    </div>
    <div id="right-column" class="column-ms">
        <div class="page-title">Register</div>
        <hr class="delimiter">
        <form method="post">
            <div class="inputs">
                <input id="first-name" name="reg-name1" type="text" placeholder="First Name" title="First Name" required>
                <input id="last-name" name="reg-name2" type="text" placeholder="Last Name" title="Last Name" required>
                <input id="email" name="email" type="email" placeholder="E-mail" title="E-mail" required>
                <input id="login-register" name="reg-login" type="text" placeholder="Login" title="Login" required>
                <input id="password-register" name="reg-password" type="password" placeholder="Password" title="Password" required>
                <?php
                if(isset($_POST['reg-button'])){
                    $sessionControl = new SessionControlImpl();
                    $test = $sessionControl->addNewUser($_POST['reg-login'],md5($_POST['reg-password']),$_POST['reg-name1'],$_POST['reg-name2'], $_POST['email']);
                    $sessionControl = null;
                }
                ?>
            </div>
            <button class="simple-button register-button" name="reg-button">REGISTER</button>
        </form>
    </div>
</div>

<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>
