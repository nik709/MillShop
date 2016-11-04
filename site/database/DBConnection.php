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
    private $isSortedByPrice = true;

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
    public function getResult(){
        return $this->result;
    }

    //--------------------SORTING--------------------
    /**
     * @param $criteria : ASC or DESC
     */
    private function sortByPrice($criteria){
        if ($criteria == "ASC")
            $this->query .= " ORDER BY price ASC";
        if ($criteria == "DESC")
            $this->query .= " ORDER BY price DESC";
    }

    /**
     * @return boolean
     */
    public function isIsSortedByPrice()
    {
        return $this->isSortedByPrice;
    }

    /**
     * @param boolean $isSortedByPrice
     */
    public function setIsSortedByPrice($isSortedByPrice)
    {
        $this->isSortedByPrice = $isSortedByPrice;
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

    public function selectByCriteria($criteria, $sortMethod){
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
        if ($this->isIsSortedByPrice())
            $this->sortByPrice($sortMethod);

        $this->execueQuery();
    }

    //--------------------SHOW--------------------
    private function showImage($image, $width, $height) {
        echo "<td><img src=\"data:image/jpeg;base64," . base64_encode($image) .
            "\" width=\"" . $width . "\" height=\"" . $height . "\" /></td>";
    }

    public function showResult(){
        echo "<div>";
        echo "<table>";
        $i = 0;
        $k = 1;
        $arrayName = array();
        $arrayPrice = array();
        echo "<tr>";
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)) {
            $i++;
            foreach ($line as $col_value) {
                if ($col_value == $line['image']) {
                    $this->showImage($col_value, 175, 200);
                }
                if ($col_value == $line['name'])
                    $arrayName[] = $col_value;
                if ($col_value == $line['price'])
                    $arrayPrice[] = $col_value;
            }
            if ($i == 4){
                echo "</tr>";
                echo "<tr>";
                for ($j=0; $j<4; $j++){
                    $name = $arrayName[$j*$k];
                    $price = $arrayPrice[$j*$k];
                    echo "<td>$name $price\$</td>";
                }
                echo "</tr>";
                $i = 0;
                $k++;
            }
        }
        if ($i!=4){
            echo "<tr>";
            for ($j=count($arrayName) - $i; $j < count($arrayName); $j++){
                $name = $arrayName[$j];
                $price = $arrayPrice[$j];
                echo "<td>$name $price\$</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }
}
?>