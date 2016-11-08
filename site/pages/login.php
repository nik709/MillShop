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
include('menu.html');
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
                    <p><input id="username" name="red-name2" type="text" placeholder="Last Name"></p>
                    <p><input id="username" name="reg-login" type="text" placeholder="Login"></p>
                    <p><input id="password" name="reg-password" type="text" placeholder="Password"></p>
                    <button class = "simple-button">REGISTER</button>
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

<!-- <div class="main">
    <div class="panel">
        <a href="#login_form" id="login_pop">Войти</a>
        <a href="#join_form" id="join_pop">Регистрация</a>
    </div>

</div>

<!-- Форма №1 для модального окна
<a href="#x" class="overlay" id="login_form"></a>
<div class="popup">
    <h2>Здравствуй, Гость!</h2>
    <p>Вводи свой псевдоним и пароль</p>
    <div>
        <label for="login">Псевдоним</label>
        <input type="text" id="login" value="" />
    </div>
    <div>
        <label for="password">Пароль</label>
        <input type="password" id="password" value="" />
    </div>
    <input type="button" value="Войти" />

    <a class="close" href="#close"></a>
</div>

<!-- Форма №2 для модального окна
<a href="#x" class="overlay" id="join_form"></a>
<div class="popup">
    <h2>Регистрация</h2>
    <p>Нужно о себе кое-что рассказать</p>
    <div>
        <label for="email">Псевдоним (email)</label>
        <input type="text" id="email" value="" />
    </div>
    <div>
        <label for="pass">Пароль</label>
        <input type="password" id="pass" value="" />
    </div>
    <div>
        <label for="firstname">Имя</label>
        <input type="text" id="firstname" value="" />
    </div>
    <div>
        <label for="lastname">Фамилия</label>
        <input type="text" id="lastname" value="" />
    </div>
    <input type="button" value="Регистрация" />&nbsp;&nbsp;&nbsp;или&nbsp;&nbsp;&nbsp;<a href="#login_form" id="login_pop">Войти</a>

    <a class="close" href="#close"></a>
</div>-->

