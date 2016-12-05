<?php
session_start();

if (!empty($_POST["Add"])) {
    header("Location: ".$_SERVER["REQUEST_URI"]);
}
include ('SessionInit.php');

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