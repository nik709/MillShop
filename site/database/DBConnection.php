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
        mysqli_select_db($this->link, 'MillShop') or die('Не удалось выбрать базу данных');
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
    public function execueQuery(){
        $this->result = mysqli_query($this->link, $this->query) or die('Запрос не удался: ' .mysqli_error($this->link));
    }

    public function setQuery($query)
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
            $price -= $price*$discount;
            if ($max < $price)
                $max = $price;
        }
        $max = number_format($max, 2, '.', '');
        return $max;
    }

    //--------------------SHOW--------------------
    private function showImage($image, $width, $height) {
        echo "<img src=\"data:image/jpeg;base64," . base64_encode($image) .
            "\" width=\"" . $width . "\" height=\"" . $height . "\" />";
    }

    public function showResult(){
        echo "<div class='results-of-query'>";
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)) {
            $k = false;
            echo "<div class=\"item\">";
            foreach ($line as $col_value) {
                if ($col_value == $line['image']) {
                    $this->showImage($col_value, 175, 200);
                }
                if ($col_value == $line['name']) {
                    $name = $col_value;
                }
                if ($col_value == $line['price']) {
                    $price = $col_value;
                }
                if ($col_value == $line['discount'])
                    $discount = $col_value;
            }
            if (!$k){
                echo "<br>";
                echo "$name";
                echo "<br>";
                $price = number_format($price, 2, '.', '');
                echo "\$$price ";
                if ($discount!=0){
                    $discount *= 100;
                    echo "    $discount% OFF";
                    $newPrice = $price - $price*$discount/100;
                    $newPrice = number_format($newPrice, 2, '.', '');
                    echo "<div style=\"color: red\">NEW PRICE: \$$newPrice</div>";
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
}
?>