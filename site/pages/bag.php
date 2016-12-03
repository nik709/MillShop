<?php
session_start();
if (!isset($_SESSION['count']))
    $_SESSION['count'] = 0;

if (!isset($_SESSION['item']))
    $_SESSION['item'] = array();

if (!isset($_SESSION['quant']))
    $_SESSION['quant'] = array();

if (!isset($_SESSION['size']))
    $_SESSION['size'] = array();

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
?>

<!-- MAIN BLOCK START -->

<form method="post">
<!-- PAGE TILTE -->
    <div id="bag-header-wrapper">
        <div class="page-title" id="page-title">My bag</div>
        <div id="clear-bag-button-wrapper">
            <button class="clear-bag-button" name="clearBag">Clear Bag</button>
        </div>
    </div>
    <hr class="delimiter">

    <?php
    if(isset($_POST['clearBag']) && isset($_SESSION['item'])
        && isset($_SESSION['item']) && isset($_SESSION['item'])) {
            unset($_SESSION['item']);
            unset($_SESSION['quant']);
            unset($_SESSION['size']);
            $_SESSION['count'] = 0;
        //session_destroy();

        header("Location: bag.php") ;
    }

    include_once ("../database/QueryPresenterImpl.php");
    $db = new QueryPresenterImpl();
    foreach ($_SESSION['item'] as $value) {
        $db->getItemById($value);
    }
    ?>
</form>

<form method="post" action="CheckOut.php">
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
            <tr>
                <td class="table-cell">1</td>
                <td class="table-cell">IMAGE GOES HERE</td>
                <td class="table-cell">Tempest Short</td>
                <td class="table-cell">M</td>
                <td class="table-cell">Blue</td>
                <td class="table-cell">
                    <input type="number" class='simple-textbox simple-spinner' name='itemQuantity' id='item-presenter-quantity-spinner' value='1' min='1' max='10'>
                </td>
                <td class="table-cell">Remove</td>
            </tr>
        </table>
    </div>

   <button class="simple-button checkout-button" name="checkoutButton">CHECKOUT</button>
</form>

<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>