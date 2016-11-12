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
        echo "<div class='results-of-query'>";
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)) {
            $k = false;
            echo "<div class=\"item-holder\">";
            foreach ($line as $col_value) {
                if ($col_value == $line['image']) {
                    echo "<a href='Men.php'>";
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
            if (!$k){
                echo "<a href='Men.php' style='text-decoration: none; color: black'>";
                echo "<div class='item-holder-name'>";
                echo "$name";
                echo "</div>";
                echo "</a>";
                if ($discount==0) {
                    echo "<div class='item-holder-price-holder'>";
                    $price = number_format($price, 2, '.', '');
                    echo "<div class='item-holder-price'>";
                    echo "\$$price";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='item-holder-new-price'>";
                    echo "&nbsp;";
                    echo "</div>";
                }
                else {
                    $price = number_format($price, 2, '.', '');
                    echo "<div class='item-holder-old-price'>";
                    echo "\$$price";
                    echo "</div>";
                    echo "<div class='item-holder-price-holder'>";
                    $discount *= 100;
                    $newPrice = $price - $price*$discount/100;
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
        }

        echo "</div>";
    }

    protected function getResult()
    {
        return $this->result;
    }


}
?>