<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

/* Задаем переменные */
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$message = htmlspecialchars($_POST["message"]);

$address = "mill.shop@mail.ru";
$sub = "Сообщение с сайта";


$mes = "Сообщение с сайта.\n
Имя отправителя: $name 
Электронный адрес отправителя: $email
Текст сообщения: $message";

    $from  = "From: $name <$email> \r\n Reply-To: $email \r\n";
    if (mail($address, $sub, $mes, $from))
        header('Location: Feedback.php');
    else
        header('Location: Feedback.php');

exit;
?>