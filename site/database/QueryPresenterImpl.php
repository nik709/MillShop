<?php
/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

function startsWith($haystack, $needle)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

include_once ("../database/DBConnection.php");
include_once("../database/QueryPresenter.php");
class QueryPresenterImpl extends DBConnection implements QueryPresenter
{
    private $sortOption;

    function __construct(){
       parent::__construct();
    }
    
    function __destruct(){
        parent::__destruct();
    }

    public function getItemById($id){
        $query = "SELECT name, image, price, size, color, discount FROM items WHERE id = '$id'";
        parent::setQuery($query);
        parent::executeQuery("Get item by ID");
    }

    public function getItemsBySizes($sizes)
    {
        // TODO: Implement getItemsBySizes() method.
    }

    public function getItemsByColor($color)
    {
        $query = "SELECT name, image, price, size, color, discount FROM items WHERE color = '$color' ";
        parent::setQuery($query);
        parent::sorting($this->sortOption);
        parent::executeQuery("Get items by ID");
    }

    public function getItemsByCriteria($criteria)
    {
        $query = "SELECT * FROM ITEMS ";
        $colors = array();
        $sizes = array();
        $quantityOfColors = 0;
        $quantityOfSizes = 0;
        for ($i=0; $i<count($criteria); $i++){
            if (startsWith($criteria[$i], "color")){
                $nameOfColor = substr($criteria[$i],8, strlen($criteria[$i]));
                $colors[$quantityOfColors] = " color = (SELECT id FROM colors WHERE colors.name = '$nameOfColor')";
                $quantityOfColors++;
            }

            if (startsWith($criteria[$i], "size")){
                $nameOfSize = substr($criteria[$i],7, strlen($criteria[$i]));
                $sizes[$quantityOfSizes] = " size = (SELECT id FROM sizes WHERE sizes.name = '$nameOfSize')";
                $quantityOfSizes++;
            }
        }
        for ($i=0; $i<$quantityOfColors; $i++) {
            if ($i == 0)
                $query .= "WHERE (";
            $query .= $colors[$i];
            if ($i != $quantityOfColors-1)
                $query .= " OR";
            else
                $query .= ")";
        }

        if ($quantityOfColors > 0){
            $query .= "AND (";
        }

        for ($i=0; $i<$quantityOfSizes; $i++){
            if ($quantityOfColors == 0 and $i==0)
                $query .= "WHERE (";
            $query .= $sizes[$i];
            if ($i != $quantityOfSizes-1)
                $query .= " OR";
            else
                $query .= ")";
        }
        parent::setQuery($query);
        parent::sorting($this->sortOption);
        parent::executeQuery("$query");
    }

    public function getMaxPrice(){
        $query = "(SELECT MAX(price) AS MAX, discount FROM ITEMS WHERE discount = 0)
                    UNION
                  (SELECT MAX(PRICE) AS MAX, discount FROM items WHERE discount > 0);";
        parent::setQuery($query);
        parent::executeQuery('max');
        $line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC);
        $max = $line['MAX'];
        $line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC);
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
        parent::setQuery($query);
        parent::executeQuery('min');
        $line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC);
        $min = $line['MIN'];
        $line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC);
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

    public function drawItemHolders()
    {
        parent::showResult();
    }

    public function setSortOption($sortOption)
    {
        $this->sortOption = $sortOption;
    }

    public function drawColors()
    {
        $query = "SELECT DISTINCT COLORS.NAME FROM ITEMS, COLORS WHERE ITEMS.COLOR = COLORS.ID";
        parent::setQuery($query);
        parent::executeQuery("existing colors");
        $i = 0;
        while ($line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC)){
            $color = $line['NAME'];
            echo "<div class='simple-checkbox-wrapper'><input type=\"checkbox\" class='simple-checkbox' id='color-$i' name=\"Color-$i\" value=\"$color\" 
                        onchange=\"setColor(this.name, this.value, this.checked)\"";
            if (isset($_GET["Color-$i"])) {
                echo "checked='checked'";
            }
            echo "/><label for='color-$i'>$color</label></div><Br>";
            $i++;
        }
    }

    public function drawSizes()
    {
        $query = "SELECT DISTINCT SIZES.NAME FROM ITEMS, SIZES WHERE ITEMS.SIZE = SIZES.ID";
        parent::setQuery($query);
        parent::executeQuery("existing colors");
        $i = 0;
        while ($line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC)){
            $size = $line['NAME'];
            echo "<div class='simple-checkbox-wrapper'><input type=\"checkbox\" class='simple-checkbox' id='size-$i' name=\"Size-$i\" value=\"$size\" 
                        onchange=\"criteriaAndSortingForm.submit()\"";
            if (isset($_GET["Size-$i"])) {
                echo "checked='checked'";
            }
            echo "/><label for='size-$i'>$size</label></div><Br>";
            $i++;
        }
    }


}