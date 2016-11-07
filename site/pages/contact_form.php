<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

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
        echo 'The letter was sent, in 5 seconds you will return to the site';}
    else {
        header('Refresh: 5; URL=MillShop.php');
        echo 'The letter was not sent, in 5 seconds you will return to the site';}

exit; /* Выход без сообщения, если поле bezspama чем-то заполнено */
?>

