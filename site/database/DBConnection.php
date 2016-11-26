<?php

/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */
class DBConnection
{
    protected $link;
    private $query;
    private $result;

    function __construct(){
        //echo "construct db";
        $this->openConnection();
    }

    function __destruct()
    {
        //echo "destruct db";
        $this->closeConnection();
    }

    //--------------------CONNECTION--------------------
    private function openConnection(){
        $this->link = mysqli_connect('localhost:3306', 'root', 'root', 'millshop');
        if (!$this->link) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "../pages/500.php"';
            echo '</script>';
        }
        //echo 'Соединение успешно установлено';
        $selected = mysqli_select_db($this->link, 'MillShop');
        if (!$selected){
            echo '<script type="text/javascript">';
            echo 'window.location.href = "../pages/500.php"';
            echo '</script>';
        }
    }

    private function closeConnection(){
        $isClose = mysqli_close($this->link);
        if (!$isClose){
            echo '<script type="text/javascript">';
            echo 'window.location.href = "../pages/500.php"';
            echo '</script>';
        }
    }

    //--------------------QUERY--------------------
    protected function executeQuery($reasonOfError){
        $this->result = mysqli_query($this->link, $this->query);
        if ($this->result == false){
            echo '<script type="text/javascript">';
            echo "window.location.href = \"../pages/500.php?message=$reasonOfError\"";
            echo '</script>';
        }
}

    protected function setQuery($query)
    {
        $this->query = $query;
    }

    //--------------------SORTING--------------------
    /**
     * @param $criteria : ASC or DESC
     */
    protected function sorting($criteria){
        if ($criteria == "ASC")
            $this->query .= " ORDER BY price ASC";
        if ($criteria == "DESC")
            $this->query .= " ORDER BY price DESC";
        if ($criteria == "NEWEST")
            $this->query .= " ORDER BY id DESC";
    }

    //--------------------SHOW--------------------
    protected function showImage($image, $width) {
        echo "<img src=\"data:image/jpeg;base64," . base64_encode($image) .
            "\" width=\"" . $width . "\" height=\"auto\" />";
    }

    protected function showResult(){
        $divCounter = 0;
        $line = mysqli_fetch_array($this->result, MYSQLI_ASSOC);
        if ($line == null) {
            echo "<div class='items-not-found'>";
            echo "No Items Found";
            echo "</div>";
        }
        else {
            do {
                $k = false;
                $divCounter++;
                if ($divCounter == 4) {
                    echo "<div class=\"item-holder\" style='margin-right: 0'>";
                    $divCounter = 0;
                } else {
                    echo "<div class=\"item-holder\">";
                }
                foreach ($line as $col_value) {
                    if ($col_value == $line['ID']) {
                        $ID = $col_value;
                    }
                    if ($col_value == $line['image']) {
                        echo "<a href='../pages/itemPage.php?ID=$ID'>"; // TODO: input item's id here
                        echo "<div class='item-holder-image'>";
                        $this->showImage($col_value, 215);
                        echo "</div>";
                        echo "</a>";
                    }
                    if ($col_value == $line['name']) {
                        $name = $col_value;
                    }
                    if ($col_value == $line['price']) {
                        $price = $col_value;
                    }
                    if ($col_value == $line['discount']) {
                        $discount = $col_value;
                    }
                }
                if (!$k) {
                    echo "<a href='../pages/itemPage.php?ID=$ID' style='text-decoration: none; color: black'>"; // TODO: input item's id here
                    echo "<div class='item-holder-name'>";
                    echo "$name";
                    echo "</div>";
                    echo "</a>";
                    if ($discount == 0) {
                        echo "<div class='item-holder-price-holder'>";
                        $price = number_format($price, 2, '.', '');
                        echo "<div class='item-holder-price'>";
                        echo "\$$price";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='item-holder-new-price'>";
                        echo "&nbsp;";
                        echo "</div>";
                    } else {
                        $price = number_format($price, 2, '.', '');
                        echo "<div class='item-holder-old-price'>";
                        echo "\$$price";
                        echo "</div>";
                        echo "<div class='item-holder-price-holder'>";
                        $discount *= 100;
                        $newPrice = $price - $price * $discount / 100;
                        $newPrice = number_format($newPrice, 2, '.', '');
                        echo "<div class='item-holder-new-price'>";
                        echo "\$$newPrice &nbsp;";
                        echo "</div>";
                        echo "<div class='item-holder-discount'>";
                        echo " $discount% OFF";
                        echo "</div>";
                        echo "</div>";
                    }
                    $k = true;
                }
                echo "</div>";
            } while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC));
        }
    }

    protected function printItemInformation(){
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)) {
            echo "<div class=\"item-presenter\">";
            echo "<div class='item-presenter-wrapper'>";
            foreach ($line as $col_value) {
                if ($col_value == $line['image']) {
                    echo "<div class='item-presenter-image'>";
                    $this->showImage($col_value, 370);
                    echo "</div>";
                }
                if ($col_value == $line['name']) {
                    $name = $col_value;
                }
                if ($col_value == $line['price']) {
                    $price = $col_value;
                }
                if ($col_value == $line['discount']) {
                    $discount = $col_value;
                }
                if ($col_value == $line['description']){
                    $description = $line['description'];
                }
            }
            echo "<div class='item-presenter-right-side'>";
            echo "<div class='item-presenter-name'>";
            echo "$name";
            echo "</div>";
            if ($discount==0) {
                echo "<div class='item-presenter-price-holder item-holder-price-holder'>";
                $price = number_format($price, 2, '.', '');
                echo "<div class='item-presenter-price item-holder-price'>";
                echo "\$$price";
                echo "</div>";
                echo "</div>";
            }
            else {
                $price = number_format($price, 2, '.', '');
                echo "<div class='item-presenter-old-price item-holder-old-price'>";
                echo "\$$price";
                echo "</div>";
                echo "<div class='item-presenter-price-holder item-holder-price-holder'>";
                $discount *= 100;
                $newPrice = $price - $price*$discount/100;
                $newPrice = number_format($newPrice, 2, '.', '');
                echo "<div class='item-presenter-new-price item-holder-new-price'>";
                echo "\$$newPrice &nbsp;";
                echo "</div>";
                echo "<div class='item-presenter-discount item-holder-discount'>";
                echo " $discount% OFF";
                echo "</div>";
                echo "</div>";
            }

            echo "<div class='item-presenter-color-wrapper'>";
            echo "<div class='item-presenter-color-header'>";
            echo "Color: ";
            echo "</div>";
            echo "<div class='item-presenter-color-value'>";
            echo "Name of color goes here";
            echo "</div>";
            echo "</div>";

            echo "<form method='post'>";
            echo "<div class='item-presenter-size-header'>";
            echo "Size: ";
            echo "</div>";
            echo "<div id='item-presenter-size-selection' class='item-presenter-size-selection'>";
            echo "</div>";


            echo "Quantity: ";
            echo "<input type=\"number\" class='simple-textbox simple-spinner' name='itemQuantity' id='item-presenter-quantity-spinner' value='1' min='1' max='10'>";

            echo "<div class='item-presenter-buttons'>";
            if(isset($_POST['Add']) && isset($_POST['sizeSelector'])) {
                $id = isset($_GET['ID']) ? $_GET['ID'] : null;

                if (!in_array($id, $_SESSION['item'])) {
                    array_push($_SESSION['item'], $id);
                    array_push($_SESSION['quant'], $_POST['itemQuantity']);
                    array_push($_SESSION['size'],$_POST['sizeSelector']);
                    plus($_SESSION['count'], $_POST['itemQuantity']);
                }
                else
                    if ($_POST['sizeSelector'] == $_SESSION['size'][array_search($id, $_SESSION['item'])]) {
                        $key = array_search($id, $_SESSION['item']);
                        $_SESSION['quant'][$key] += $_POST['itemQuantity'];
                        plus($_SESSION['count'], $_POST['itemQuantity']);
                    } else {
                        array_push($_SESSION['item'], $id);
                        array_push($_SESSION['quant'], $_POST['itemQuantity']);
                        array_push($_SESSION['size'], $_POST['sizeSelector']);
                        plus($_SESSION['count'], $_POST['itemQuantity']);
                    }

            }
            echo "<button id='add-to-bag' class='simple-button add-to-bag' name='Add' value='Add to bag''>ADD TO BAG</button>";
            echo "</div>";
            echo "</form>";


            echo "</div>";
            echo "</div>";

            echo "<div class='item-presenter-description-wrapper'>";
            echo "<div class='item-presenter-description-header'>";
            echo "Item's Description";
            echo "<hr class='delimiter'>";
            echo "</div>";
            echo "<div class='item-presenter-description-description'>";
            echo "$description";
            echo "</div>";
            echo "</div>";

            echo "</div>";
        }
    }

    //--------------------GETTER--------------------
    protected function getResult()
    {
        return $this->result;
    }

}
?>