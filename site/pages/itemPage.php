<?php
session_start();

if (!empty($_POST["Add"])) {
    header("Location: ".$_SERVER["REQUEST_URI"]);
}
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
}
if (!isset($_SESSION['item'])){
    $_SESSION['item'] = array();
}
if (!isset($_SESSION['quant'])) {
    $_SESSION['quant'] = array();
}
if (!isset($_SESSION['size'])) {
    $_SESSION['size'] = array();
}

function plus($bag,$quant)
{
    $bag+=$quant;
    $_SESSION['count'] = $bag;
}

include_once ('../database/QueryPresenterImpl.php');
$db = new QueryPresenterImpl();
$id = isset($_GET['ID']) ? $_GET['ID'] : null;
?>
<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $db->getNameById($id); ?> - Mill Shop</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
<?php
include('menu.php');
?>

<!-- MAIN BLOCK START -->

<div id="item-page-header-wrapper">
    <div class="item-page-header">Global Category</div>
    <div class="item-page-header-divider">></div>
    <div class="item-page-header">Subcategory</div>
</div>
<hr class="delimiter">

<?php
$db->getItemById($id);
$db->printItemInformation();
if (!empty($_POST["Add"])) {
    exit();
}
?>

<script type="text/javascript">
    document.getElementById('item-presenter-size-selection').innerHTML = '<?php $db->drawSizeSelector($id); ?>';
</script>
<div class="filler"></div>

<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>