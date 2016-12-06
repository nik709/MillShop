<?php
session_start();
include ('SessionInit.php');
function showImg($image) {
    echo "<img src=\"data:image/jpeg;base64," . base64_encode($image) .
"\" width=\"" . 40 . "\" height=\"auto\" />";
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
<?php
if(isset($_SESSION['user-login']))
   echo"<form method=\"post\" action=\"CheckOut.php\">";
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
            $num=1;
            foreach ($_SESSION['item'] as $value) {
                $quant=$_SESSION['quant'][$num-1];
                $test = $sessionControl->getItemInfo($value);
                echo "<tr>";
                echo "<td class=\"table-cell\">";  echo $num;                                   echo"</td>";
                echo "<td class=\"table-cell\">";  echo showImg($test[0]);                      echo"</td>";
                echo "<td class=\"table-cell\">";  echo $test[1];                               echo"</td>";
                echo "<td class=\"table-cell\">";  echo $_SESSION['size'][$num-1];              echo"</td>";
                echo "<td class=\"table-cell\">";  echo $sessionControl->getColor($test[2]);    echo"</td>";
                echo "<td class=\"table-cell\">";
                echo "<input type=\"number\" class='simple-textbox simple-spinner' name='itemQuantity' id='item-presenter-quantity-spinner' value='$quant' min='1' max='10'>";
                echo "</td>";
                echo "<td class=\"table-cell\">Remove</td>";
                echo "</tr>";
                $num+=1;
            }
            ?>

        </table>
    </div>
    <?php
        if(count($_SESSION['item'])>0)
            echo "<button class=\"simple-button checkout-button\" name=\"checkoutButton\" onclick='this.disabled=false'>CHECKOUT</button>";
        else
            echo "<button class=\"simple-button-dis checkout-button\" name=\"checkoutButton\" onclick='this.disabled=true'>CHECKOUT</button>";
    ?>
</form>
<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>