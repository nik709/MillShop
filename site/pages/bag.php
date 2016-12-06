<?php
session_start();
include ('SessionInit.php');

function drawImage($image) {
    echo "<img src=\"data:image/jpeg;base64," . base64_encode($image) .
"\" width=\"" . 160 . "\" height=\"auto\" />";
}
?>
<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bag - Mill Shop</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/Bag.css">
</head>
<body>
<?php
include('menu.php');
include_once ("../database/SessionControlImpl.php");
?>

<!-- MAIN BLOCK START -->

<?php
if(isset($_SESSION['item'])) {
    $sessionControl = new SessionControlImpl();
}

?>
<!-- PAGE TILTE -->

<form method="post">
    <div id="bag-header-wrapper">
        <div class="page-title" id="page-title">My bag</div>
        <div id="clear-bag-button-wrapper">
            <button class="clear-bag-button" name="clearBag">Clear Bag</button>
        </div>
    </div>
    <hr class="delimiter">

    <?php
    if(isset($_POST['clearBag']) && isset($_SESSION['item'])) {
            unset($_SESSION['item']);
            unset($_SESSION['quant']);
            unset($_SESSION['size']);
            $_SESSION['count'] = 0;
        header("Location: bag.php") ;
    }
    ?>
</form>

<div class="bag-content">
<?php
if(isset($_SESSION['user-login']))
   echo"<form method=\"post\" action=\"checkout.php\">";
else
    echo"<form method=\"post\" action=\"login.php\">";
?>
    <div class="bag-table-wrapper">
        <table id="bag-table">
            <tr class="table-header">
                <td class="table-cell-header">№</td>
                <td class="table-cell-header">Image</td>
                <td class="table-cell-header">Name</td>
                <td class="table-cell-header">Size</td>
                <td class="table-cell-header">Color</td>
                <td class="table-cell-header">Quantity</td>
                <td class="table-cell-header"><!--Remove--></td>
            </tr>

            <?php
            $num = 1;
            foreach ($_SESSION['item'] as $value) {
                $quantity=$_SESSION['quant'][$num-1];
                $queryResult = $sessionControl->getItemInfo($value);
                echo "<tr>";
                echo "<td class=\"table-cell\">$num</td>";
                echo "<td class=\"table-cell-image\">";
                    drawImage($queryResult[0]);
                echo "</td>";
                echo "<td class=\"table-cell\">" . $queryResult[1] . "</td>";
                echo "<td class=\"table-cell\">" . $_SESSION['size'][$num-1] . "</td>";
                echo "<td class=\"table-cell\">" . $sessionControl->getColor($queryResult[2]) . "</td>";
                echo "<td class=\"table-cell-quantity\">";
                echo "<input type=\"number\" class='simple-textbox simple-spinner' name='itemQuantity' id='item-presenter-quantity-spinner' value='$quantity' min='1' max='10'>";
                echo "</td>";
                echo "<td class=\"table-cell\">Remove</td>";
                echo "</tr>";
                $num++;
            }
            ?>

        </table>
    </div>
    <?php
    echo "<button class=\"simple-button checkout-button\" name=\"checkoutButton\" ";
        if(count($_SESSION['item']) == 0)
            echo "disabled";
        echo ">CHECKOUT</button>";
    ?>
</form>
</div>
<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>