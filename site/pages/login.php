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
                    $_SESSION['user-login']=$_POST['login'];
                    $_SESSION['user-pass']=$_POST['password'];
                    session_start();
                //Тут должна быть проверка правильности ввода через БД
                }
                ?>
                <button class = "simple-button" name="log-but">LOG IN</button>
                </form>
            </fieldset>
        </div>

        <div>
            <div style="font-size: 30px; margin-bottom: 15px;">REGISTER</div>
            <fieldset id="inputs">
                <form method="post">
                    <p><input id="username" name="reg-name1" type="text" placeholder="First Name"></p>
                    <p><input id="username" name="reg-name2" type="text" placeholder="Last Name"></p>
                    <p><input id="username" name="reg-login" type="text" placeholder="Login"></p>
                    <p><input id="password" name="reg-password" type="text" placeholder="Password"></p>
                    <?php
                    if(isset($_POST['reg-button'])){
                        include_once("../database/DBConnection.php");
                        $db = new DBConnection();
                       // $db->openConnection();
                        $db->addUser($_POST['reg-login'],$_POST['reg-password'],$_POST['reg-name1'],$_POST['reg-name2']);
                       // $db->closeConnection();
                    }
                    ?>
                    <button class = "simple-button" name="reg-button">REGISTER</button>
                </form>
            </fieldset>
        </div>
    </div>



      <!--  <input type="submit" id="submit" value="ВОЙТИ">-->




<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>
