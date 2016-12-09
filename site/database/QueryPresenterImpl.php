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

function stringParser($str){
    $str=preg_replace('/\s+/',' ',$str);
    return $str;
}

include_once ("DBConnection.php");
include_once("QueryPresenter.php");
class QueryPresenterImpl extends DBConnection implements QueryPresenter
{
    private $sortOption;
    private $globalCategory;

    function __construct(){
       parent::__construct();
        $this->globalCategory = null;
    }
    
    function __destruct(){
        parent::__destruct();
    }

    //-------------------GETTERS-------------------
    public function getItemById($id){
        $query = "SELECT items.ID, items.name, image, price, colors.name AS COLOR, discount, description, globcategory.name AS GLOB, subcategory.name AS SUB
                  FROM items, globcategory, subcategory, colors
                  WHERE items.subcategory = subcategory.id 
                    AND items.globcategory = globcategory.id 
                    AND items.color = colors.id
                    AND items.ID = $id";
        parent::setQuery($query);
        parent::executeQuery("Get item by ID");
    }

    public function getItemsByColor($color)
    {
        $query = "SELECT ID, name, image, price, color, discount FROM items WHERE color = '$color' ";
        if ($this->globalCategory != null)
            $query .= " AND globcategory = $this->globalCategory";
        parent::setQuery($query);
        parent::sorting($this->sortOption);
        parent::executeQuery("Get items by COLOR");
    }

    public function getItemsByCriteria($criteria)
    {
        $query = "SELECT DISTINCT ID, name, price, discount, image FROM items, items_sizes WHERE items.ID = items_sizes.item_id ";
        $colors = array();
        $sizes = array();
        $subs = array();
        $prices = array();
        $quantityOfColors = 0;
        $quantityOfSizes = 0;
        $quantityOfSubs = 0;
        $p = 0;
        for ($i=0; $i<count($criteria); $i++){
            if (startsWith($criteria[$i], "color")){
                $nameOfColor = substr($criteria[$i],8, strlen($criteria[$i]));
                $colors[$quantityOfColors] = " color = (SELECT id FROM colors WHERE colors.name = '$nameOfColor')";
                //echo "$colors[$quantityOfColors]";
                $quantityOfColors++;
            }

            if (startsWith($criteria[$i], "size")){
                $nameOfSize = substr($criteria[$i],7, strlen($criteria[$i]));
                $sizes[$quantityOfSizes] = " size_id = (SELECT ID FROM sizes WHERE name = '$nameOfSize')";
                $quantityOfSizes++;
            }

            if (startsWith($criteria[$i], "category")){
                $idOfSub = substr($criteria[$i], 10, strlen($criteria[$i]));
                $subs[$quantityOfSubs] = " subcategory = $idOfSub";
                $quantityOfSubs++;
            }
            if (startsWith($criteria[$i], "price")){
                $priceN = substr($criteria[$i], 8, strlen($criteria[$i]));
                //echo "$priceN<br>";
                if ($p==0)
                    $prices[$p] = " price > $priceN + price * discount";
                else
                    if ($p<2)
                        $prices[$p] = "price < $priceN - price * discount";
                $p++;
            }
        }
        for ($i=0; $i<$quantityOfColors; $i++) {
            if ($i == 0)
                $query .= "AND (";
            $query .= $colors[$i];
            if ($i != $quantityOfColors-1)
                $query .= " OR";
            else
                $query .= ")";
        }

        if ($quantityOfSizes>0 and $quantityOfColors>0){
            $query .= "AND (";
        }

        for ($i=0; $i<$quantityOfSizes; $i++){
            if ($quantityOfColors == 0 and $i==0)
                $query .= "AND (";
            $query .= $sizes[$i];
            if ($i != $quantityOfSizes-1)
                $query .= " OR";
            else
                $query .= ")";
        }

        for ($i=0; $i<$quantityOfSubs; $i++){
            if ($i==0)
                $query .= "AND (";
            $query .= $subs[$i];
            if ($i != $quantityOfSubs-1)
                $query .= " OR";
            else
                $query .= ")";
            //echo "<br> $query";
        }

        //echo "$p";
        if ($p == 2) {
            for ($i = 0; $i < $p; $i++) {
                if ($i == 0)
                    $query .= " AND (";
                $query .= $prices[$i];
                if ($i != $p-1)
                    $query .= " AND ";
                else
                    $query .= ")";
            }
        }

        if ($this->globalCategory != null)
            $query .= " AND globcategory = $this->globalCategory";

        parent::setQuery($query);
        parent::sorting($this->sortOption);
        parent::executeQuery("$query");
        //echo "$query";
    }

    public function getMaxPrice(){
        $query = "(SELECT MAX(price) AS MAX, discount FROM items WHERE discount = 0 and globcategory = $this->globalCategory)
                    UNION
                  (SELECT MAX(PRICE) AS MAX, discount FROM items WHERE discount > 0 and globcategory = $this->globalCategory);";
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
        $query = "(SELECT MIN(price) MIN FROM items WHERE discount = 0 and globcategory = $this->globalCategory)
                    UNION
                    (SELECT MIN(price - items.price*items.discount) MIN FROM items WHERE discount > 0 and globcategory = $this->globalCategory);";
        parent::setQuery($query);
        parent::executeQuery($query);
        $line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC);
        $min = $line['MIN'];
        $line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC);
        if ($line['MIN'] != null) {
            $price = $line['MIN'];
            if ($min > $price)
                $min = $price;
        }
        $min = number_format($min, 2, '.', '');
        return $min;
    }

    public function getNameById($id){
        $query = "SELECT name FROM items WHERE ID = $id";
        parent::setQuery($query);
        parent::executeQuery("Get name by ID");
        $line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC);
        return $line['name'];
    }

    public function getSearchResult($searchString)
    {
        $query = "SELECT * FROM items WHERE ";
        $searchString = stringParser($searchString);
        $words = explode(" ",$searchString);
        $position = 0;
        foreach ($words as $word){
            $position++;
            if (!startsWith($word, " ")) {
                $query .= "UPPER(name) LIKE UPPER('%$word%')
                            OR color in 
                                (SELECT id FROM colors WHERE colors.name LIKE UPPER('%$word%'))
                            OR subcategory in 
                                (SELECT id FROM subcategory WHERE subcategory.name LIKE UPPER('%$word%'))
                            OR globcategory in 
                                (SELECT id FROM globcategory WHERE UPPER(globcategory.name) = UPPER('$word'))";
            }
            if ($position!=0 and $position!= count($words))
                $query .= " OR ";
        }
        //echo "$query";
        parent::setQuery($query);
        parent::executeQuery($query);
    }

    private function getSizesById($id){
        $query = "SELECT sizes.name AS NAME
                    FROM items, items_sizes, sizes
                    WHERE items.id = items_sizes.item_id
                    AND items_sizes.size_id = sizes.id
                    AND items.id = $id
                    ORDER BY sizes.id";

        parent::setQuery($query);
        parent::executeQuery("Get sizes by ID");
        $result = array();
        $i = 0;
        while ($line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC)){
            $result[$i] = $line['NAME'];
            $i++;
        }

        return $result;
    }

    //-------------------DRAW-------------------
    public function drawItemHolders()
    {
        parent::showResult();
    }

    public function drawColors()
    {
        $query = "SELECT DISTINCT colors.NAME FROM items, colors WHERE items.COLOR = colors.ID";
        if ($this->globalCategory != null)
            $query .= " AND globcategory = $this->globalCategory";
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
        $query = "select DISTINCT sizes.name AS NAME
                  from items_sizes, sizes
                  where items_sizes.size_id = sizes.ID";
        parent::setQuery($query);
        parent::executeQuery("existing size");
        $i = 0;
        while ($line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC)){
            $size = $line['NAME'];
            echo "<div class='simple-checkbox-wrapper'><input type=\"checkbox\" class='simple-checkbox' id='size-$i' name=\"Size-$i\" value=\"$size\" 
                        onchange=\"setSize(this.name, this.value, this.checked)\"";
            if (isset($_GET["Size-$i"])) {
                echo "checked='checked'";
            }
            echo "/><label for='size-$i'>$size</label></div><Br>";
            $i++;
        }
    }

    public function drawSubcategory()
    {
        $query = "SELECT DISTINCT subcategory.name AS NAME, subcategory.ID AS ID
                  FROM subcategory, items
                  WHERE subcategory.id = items.subcategory";
        if ($this->globalCategory != null)
            $query .= " AND items.globcategory = $this->globalCategory";
        parent::setQuery($query);
        parent::executeQuery("$query");
        $i = 0;
        while ($line = mysqli_fetch_array(parent::getResult(), MYSQLI_ASSOC)){
            $sub = $line['NAME'];
            $id = $line['ID'];
            echo "<div class='simple-checkbox-wrapper'><input type=\"checkbox\" class='simple-checkbox' id='Category-$i' name=\"Category-$i\" value=\"$id\"
                        onchange=\"setSubcategory(this.name, this.value, this.checked)\"";
            if (isset($_GET["Category-$i"])) {
                echo "checked='checked'";
            }
            echo "/><label for='Category-$i'>$sub</label></div><Br>";
            $i++;
        }
    }

    public function printItemInformation()
    {
        parent::printItemInformation();
    }

    public function drawSizeSelector($id){
        //echo "<select name=\"sizeOfItem\" id=\"sizeOfItem\" class=\"simple-select\" onchange=\"\" title=\"Choose Size\">";
        //echo "    <option value=\"\" selected disabled style=\"display:none;\">Choose Size...</option>";
        $sizes = $this->getSizesById($id);
        foreach ($sizes as $size) {
            //echo "<option value=\"$size\">$size</option>\";";
            echo "<div class=\"simple-radio-wrapper\">";
            echo "<input type=\"radio\" value=\"$size\" class=\"simple-radio\" name=\"sizeSelector\" id=\"$size\">";
            echo "<label for=\"$size\">$size</label>";
            echo "</div>";
        }
        //echo "</select>";
    }

    //-------------------SETTER-------------------
    public function setSortOption($sortOption)
    {
        $this->sortOption = $sortOption;
    }

    public function setGlobalCategory($globalCategory)
    {
        $this->globalCategory = $globalCategory;
    }


}