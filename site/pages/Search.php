<?php
session_start();
include ('SessionInit.php');

?>
<!DOCTYPE html>
<!--
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results - Mill Shop</title>
    <link rel="icon" href="../resources/images/icon.ico">
    <link rel="stylesheet" href="../css/MillShop.css">
</head>
<body>
<?php
include('menu.php');
$search = isset($_GET['search']) ? $_GET['search'] : null;
?>

<!-- MAIN BLOCK START -->

<div class="search-header-wrapper">
    <div class="search-results-header">Search results for</div>
    <div class="search-string"><?php echo "$search"?></div>
</div>
<div class="delimiter"></div>

<?php
include_once ("../database/QueryPresenterImpl.php");
$db = new QueryPresenterImpl();
if (($search) == null) {
    $db->onFailed("Search failed");
}

echo "test: <br> $search <br>";
//$search = stringParser($search);
//echo "$search";
$db->getSearchResult($search);
echo "<div class='results-of-query' id='results-of-query'>";
$db->drawItemHolders();
echo "</div>";
?>

<!-- MAIN BLOCK END -->

<?php
include('footer.html');
?>
</body>
</html>