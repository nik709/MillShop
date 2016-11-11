<?php

/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

class DBConnection
{
    private $link;
    private $query;
    private $result;
    private $sortOption = null;

    //--------------------CONNECTION--------------------
    public function openConnection(){
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

    public function closeConnection(){
        $isClose = mysqli_close($this->link);
        if (!$isClose){
            echo '<script type="text/javascript">';
            echo 'window.location.href = "../pages/500.php"';
            echo '</script>';
        }
    }

    //--------------------QUERY--------------------
    private function execueQuery(){
        $this->result = mysqli_query($this->link, $this->query);
        if ($this->result == false){
            echo '<script type="text/javascript">';
            echo 'window.location.href = "../pages/500.php"';
            echo '</script>';
        }
}

    private function setQuery($query)
    {
        $this->query = $query;
    }

    //--------------------RESULT--------------------
    private function getResult(){
        return $this->result;
    }

    //--------------------SORTING--------------------
    /**
     * @param $criteria : ASC or DESC
     */
    private function sorting($criteria){
        if ($criteria == "ASC")
            $this->query .= " ORDER BY price ASC";
        if ($criteria == "DESC")
            $this->query .= " ORDER BY price DESC";
        if ($criteria == "NEWEST")
            $this->query .= " ORDER BY id DESC";
    }

    public function getSortOption()
    {
        return $this->sortOption;
    }

    public function setSortOption($criteriaOfSort)
    {
        $this->sortOption = $criteriaOfSort;
    }



    //--------------------SELECTS--------------------
    public function selectItemsById($id){
        $query = "SELECT name, image, price, size, color, description FROM items WHERE id = '$id'";
        $this->setQuery($query);
        $this->execueQuery();
    }

    public function selectItemsBySize($size){
        $query = "SELECT name, image, price, size, color, description FROM items WHERE size = '$size'";
        if ($this->isIsSortedByPrice())
            $this->sortByPrice("ASC");
        $this->setQuery($query);
        $this->execueQuery();
    }

    public function selectItemsByColor($color){
        $query = "SELECT name, image, price, size, color, description FROM items WHERE color = '$color'";
        if ($this->isIsSortedByPrice())
            $this->sortByPrice("ASC");
        $this->setQuery($query);
        $this->execueQuery();
    }

    public function selectByCriteria($criteria){
        $query = "SELECT * FROM ITEMS ";
        for ($i=0; $i<count($criteria); $i++){
            if ($i==0)
                $query .= "WHERE ";
            $query .= $criteria[$i];
            $query .= " ";
            if ($i!=count($criteria) - 1)
                $query .= "AND ";
        }
        $this->setQuery($query);
        $this->sorting($this->sortOption);

        $this->execueQuery();
    }

    public function getMaxPrice(){
        $query = "(SELECT MAX(price) AS MAX, discount FROM ITEMS WHERE discount = 0)
                    UNION
                  (SELECT MAX(PRICE) AS MAX, discount FROM items WHERE discount > 0);";
        $this->setQuery($query);
        $this->execueQuery();
        $line = mysqli_fetch_array($this->result, MYSQLI_ASSOC);
        $max = $line['MAX'];
        $line = mysqli_fetch_array($this->result, MYSQLI_ASSOC);
        if ($line != null) {
            $price = $line['MAX'];
            $discount = $line['discount'];
            $price -= $price * $discount;
            if ($max < $price)
                $max = $price;
        }
        $max = number_format($max, 2, '.', '');
        return $max;
    }

    public function getMinPrice(){
        $query = "(SELECT MIN(price) AS MIN, discount FROM ITEMS WHERE discount = 0)
                    UNION
                    (SELECT MIN(PRICE) AS MIN, discount FROM items WHERE discount > 0);";
        $this->setQuery($query);
        $this->execueQuery();
        $line = mysqli_fetch_array($this->result, MYSQLI_ASSOC);
        $min = $line['MIN'];
        $line = mysqli_fetch_array($this->result, MYSQLI_ASSOC);
        if ($line != null) {
            $price = $line['MIN'];
            $discount = $line['discount'];
            $price -= $price * $discount;
            if ($min > $price)
                $min = $price;
        }
        $min = number_format($min, 2, '.', '');
        return $min;
    }

    //--------------------SHOW--------------------
    private function showImage($image, $width) {
        echo "<img src=\"data:image/jpeg;base64," . base64_encode($image) .
            "\" width=\"" . $width . "\" height=\"auto\" />";
    }

    public function showResult(){
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

    public function showColors(){
        $query = "SELECT DISTINCT COLORS.NAME FROM ITEMS, COLORS WHERE ITEMS.COLOR = COLORS.ID";
        $this->setQuery($query);
        $this->execueQuery();
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)){
            $color = $line['NAME'];
            echo "<input type=\"checkbox\" name=\"Size\" value=\"$color\" unchecked>$color<Br>";
        }
    }

    public function showSizes(){
        $query = "SELECT DISTINCT SIZES.NAME FROM ITEMS, SIZES WHERE ITEMS.SIZE = SIZES.ID";
        $this->setQuery($query);
        $this->execueQuery();
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)){
            $size = $line['NAME'];
            echo "<input type=\"checkbox\" name=\"Size\" value=\"$size\" unchecked>$size<Br>";
        }
    }

    //--------------------ADD USER--------------------
    public function addUser($login, $password, $firstname, $lastname){
        $query = "INSERT INTO `millshop`.`users` (LOGIN, PASSWORD, FIRSTNAME, LASTNAME) VALUES ('$login', '$password', '$firstname', '$lastname');";
        $this->setQuery($query);
        $this->execueQuery();
    }
}
?>