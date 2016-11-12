<?php

/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 11.11.2016
 * Time: 23:51
 */
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
        for ($i=0; $i<count($criteria); $i++){
            if ($i==0)
                $query .= "WHERE ";
            $query .= $criteria[$i];
            $query .= " ";
            if ($i!=count($criteria) - 1)
                $query .= "AND ";
        }
        parent::setQuery($query);
        parent::sorting($this->sortOption);
        parent::executeQuery("Get items by criteria");
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
        while ($line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC)){
            $color = $line['NAME'];
            echo "<input type=\"checkbox\" name=\"Size\" value=\"$color\" unchecked>$color<Br>";
        }
    }

    public function drawSizes()
    {
        $query = "SELECT DISTINCT SIZES.NAME FROM ITEMS, SIZES WHERE ITEMS.SIZE = SIZES.ID";
        parent::setQuery($query);
        parent::executeQuery("existing colors");
        while ($line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC)){
            $size = $line['NAME'];
            echo "<input type=\"checkbox\" name=\"Size\" value=\"$size\" unchecked>$size<Br>";
        }
    }


}