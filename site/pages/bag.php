<?php
session_start();
include ('SessionInit.php');

function drawImage($image) {
    echo "<img src=\"data:image/jpeg;base64," . base64_encode($image) .
"\" width=\"" . 130 . "\" height=\"auto\" />";
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

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script type="text/javascript">
        function removeItem(id) {
            $.get("scripts/RemoveItemFromBag.php?valueId=" + id);
            location.reload();
            return false;
        }
    </script>
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
<form method="post">
    <div class="bag-table-wrapper">
        <table id="bag-table">
            <tr class="table-header">
                <td class="table-cell-header">№</td>
                <td class="table-cell-header">Image</td>
                <td class="table-cell-header">Name</td>
                <td class="table-cell-header">Size</td>
                <td class="table-cell-header">Color</td>
                <td class="table-cell-header">Quantity</td>
                <td class="table-cell-header">Price</td>
                <td class="table-cell-header"><!--Remove--></td>
            </tr>

            <?php
            $totalPrice = 0;
            $num = 0;
            foreach ($_SESSION['item'] as $value) {
                $quant=$_SESSION['quant'][array_search($value, $_SESSION['item'])];
                $bagElem = $sessionControl->getItemInfo($value);
                $price=round($bagElem[3]*(1-$bagElem[4]),2);
                $id=$_SESSION['item'][array_search($value, $_SESSION['item'])];
                $path="itemPage.php?ID=$id";
                $totalPrice += $price;

                echo "<tr>";
                echo "<td class=\"table-cell\">"; echo $num + 1; echo "</td>";
                echo "<td class=\"table-cell-image\">"; echo"<a href=$path>";drawImage($bagElem[0]);  echo"</a></td>";
                echo "<td class=\"table-cell\">";       echo "<a href=$path class='no-dec-link'>"; echo $bagElem[1]; echo "</a></td>";
                echo "<td class=\"table-cell\">";       echo $_SESSION['size'][array_search($value, $_SESSION['item'])];               echo "</td>";
                echo "<td class=\"table-cell\">";       echo $sessionControl->getColor($bagElem[2]);  echo "</td>";
                echo "<td class=\"table-cell-quantity\">";
                echo "<input type=\"number\" class='simple-textbox simple-spinner' name='itemQuantity' id='item-presenter-quantity-spinner' value='$quant' min='1' max='10' autocomplete='off'>";
                echo "</td>";
                echo "<td class=\"table-cell\">$$price</td>";
                echo "<td class=\"table-cell\"><input type='button' class='clear-bag-button remove-button' name='remove-button' value='Remove' onclick='removeItem(" . array_search($value, $_SESSION['item']) . ")' /></td>";
                echo "</tr>";
                $num++;
            }
            ?>
        </table>
    </div>
    <div class="total-bag">
        <div id="total-bag-name">TOTAL:</div>
        <div id="total-bag-price"><?php echo "$" . $totalPrice; ?></div>
    </div>

    <?php
    echo "<input type='button' class=\"simple-button checkout-button\" name=\"checkoutButton\" value='CHECKOUT' ";
        if(count($_SESSION['item']) == 0)
            echo "disabled";
        if(isset($_SESSION['user-login'])) {
            echo " onclick=\"location.href='\\checkout.php';\"";
        }
        else {
            echo " onclick=\"location.href='\\login.php';\"";
        }
    echo "/>";
    ?>


</form>
</div>
<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>