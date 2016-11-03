<?php

/* Задаем переменные */
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$message = htmlspecialchars($_POST["message"]);

/* Ваш адрес и тема сообщения */
$address = "mill.shop@mail.ru";
$sub = "Сообщение с сайта";

/* Формат письма */
$mes = "Сообщение с сайта.\n
Имя отправителя: $name 
Электронный адрес отправителя: $email
Текст сообщения: $message";

    /* Отправляем сообщение, используя mail() функцию */
    $from  = "From: $name <$email> \r\n Reply-To: $email \r\n";
    if (mail($address, $sub, $mes, $from)) {
        header('Refresh: 5; URL=MillShop.php');
        echo 'Письмо отправлено, через 5 секунд вы вернетесь на сайт';}
    else {
        header('Refresh: 5; URL=MillShop.php');
        echo 'Письмо не отправлено, через 5 секунд вы вернетесь на страницу';}

exit; /* Выход без сообщения, если поле bezspama чем-то заполнено */
?>

