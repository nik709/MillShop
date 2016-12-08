<!DOCTYPE html>

<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->

<?php
session_start();
include_once ("../database/SessionControlImpl.php");
$sessionControl = new SessionControlImpl();

$email = $_POST['e-mail'];
$FirstName = $_POST['first-name'];
//$LastName = $_POST['last-name'];

$country = $_POST['Country'];
$city = $_POST['City'];
$street = $_POST['Street'];
$PostalCode = $_POST['Postal Code'];
$Apt = $_POST['Apt-Bidg'];

$sub = "Thank you for your order!";

$mes="
<p>Hi, $FirstName!</p>
<p>Your order was successfully placed!</p>
<p>You have ordered:</p>
<html>
<body>
  <table cellSpacing=0 cellPadding=0 width=500 border=1>
    <tr>
        <td width=200>ITEM</td>
        <td width=100>SIZE</td>
        <td width=100>QUANTITY</td>
        <td width=100>PRICE</td>
    </tr>
</table>
</body>
</html>";

$num=1;
foreach ($_SESSION['item'] as $value){
    $quant = $_SESSION['quant'][$num - 1];
    $test = $sessionControl->getItemInfo($value);
    $size=$_SESSION['size'][$num-1];
    $price=round($test[3]*(1-$test[4]),2);
    $mes_table="
        <html>
        <body>
          <table cellSpacing=0 cellPadding=0 width=500 border=1>
            <tr>
                <td width=200>$test[1]</td>
                <td width=100>$size</td>
                <td width=100>$quant</td>
                <td width=100>$$price</td>
            </tr>
        </table>
        </body>
        </html>";
    $mes=$mes.$mes_table;
    $num+=1;
}


$mes_last_part="
<p>Your order will be sent to the following address:</p>
<p>$Apt,$street Street</p>
<p>$city,$PostalCode</p>
<p>$country</p>
";

$mes=$mes.$mes_last_part;
// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


if (mail($email, $sub, $mes, $headers))
    header('Location: checkout.php');
?>