<!DOCTYPE html>

<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->

<?php
$email = $_POST['e-mail'];
$FirstName = $_POST['first-name'];
$LastName = $_POST['last-name'];

$country = $_POST['Country'];
$city = $_POST['City'];
$street = $_POST['Street'];
$PostalCode = $_POST['Postal Code'];
$Apt = $_POST['Apt-Bidg'];

$sub = "Checkout";
if(isset($_SESSION['item']))
    $size=count($_SESSION['item']);
else
    $size=0;

$mes="
<html>
<body>
  <p>$FirstName $LastName,</p>
  <p>Your order was successfully issued!</p>
  <p>You have ordered:</p>
  <table cellSpacing=0 cellPadding=0 width=521 border=1>
    <tr>
        <td>ITEM</td>
        <td>SIZE</td>
        <td>COUNT</td>
        <td>PRICE</td>
    </tr>
    <tr>
        <td>$size</td>
        <td>$size</td>
        <td>$size</td>
        <td>$size</td>
    </tr>
</table>
</body>
</html>


<p>Your order will be sent to the following address:</p>
<p>$Apt,$street Street</p>
<p>$city,$PostalCode</p>
<p>$country</p>
";

// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


if (mail($email, $sub, $mes, $headers))
    header('Location: CheckOut.php');
?>