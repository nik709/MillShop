<?php

/**
    MILL SHOP COMPANY, 2016
    CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */
function swap(&$a, &$b){
    $c = $a;
    $a = $b;
    $b = $c;
}

function bubbleSort(&$array){
    for ($i=0; $i<count($array); $i++){
        for ($j=0; $j<count($array); $j++){
            if ($array[$i]>$array[$j])
                swap($array[$i], $array[$j]);
        }
    }
}

class DBConnection
{
    private $link;
    private $query;
    private $result;

    public function openConnection(){
        $this->link = mysqli_connect('localhost:3306', 'root', 'root', 'millshop');
        if (!$this->link) {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "../pages/500.php"';
            echo '</script>';
        }
        echo 'Соединение успешно установлено';
        mysqli_select_db($this->link, 'MillShop') or die('Не удалось выбрать базу данных');
    }

    public function execueQuery(){
        $this->result = mysqli_query($this->link, $this->query) or die('Запрос не удался: ' .mysqli_error($this->link));
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    private function showImage($image, $width, $height) {
        echo "\t\t<td><img src=\"data:image/jpeg;base64," . base64_encode($image) .
            "\" width=\"" . $width . "\" height=\"" . $height . "\" /></td>\n";
    }

    public function showResult(){
        echo "<table>\n";
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)) {
            echo "\t<tr>\n";
            foreach ($line as $col_value) {
                if($col_value == $line['image']) {
                    $this->showImage($col_value, 175, 200);
                }
                else {
                    echo "\t\t<td>$col_value</td>\n";
                }
            }
            echo "\t</tr>\n";
        }
        echo "</table>\n";
    }

    public function closeConnection(){
        $isClose = mysqli_close($this->link);
        if ($isClose){
            echo "Соединение успешно прервано";
        }
    }

    public function selectItemsById($id){
        $query = "SELECT name, image, price, size, color, description FROM items WHERE id = '$id'";
        $this->setQuery($query);
        $this->execueQuery();
    }

    public function selectItemsBySize($size){
        $query = "SELECT name, image, price, size, color, description FROM items WHERE size = '$size'";
        $this->setQuery($query);
        $this->execueQuery();
    }

    public function selectItemsByColor($color){
        $query = "SELECT name, image, price, size, color, description FROM items WHERE color = '$color'";
        $this->setQuery($query);
        $this->execueQuery();
    }

    public function getResult(){
        return $this->result;
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
        $query .= ";";
        $this->setQuery($query);
        $this->execueQuery();
        $this->sortResult();
    }

    public function sortResult(){
        $array[0] = "test";
        $i = 1;
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)){
            $array[$i] = $line;
            $i++;
        }
        bubbleSort($array);
        /*echo "<table>\n";
        foreach ($array as $item) {
            foreach ($item as $col_val)
            echo "\t<tr>\n";
            echo "\t\t<td>$col_val</td>\n";
            echo "\t</tr>\n";
        }
        echo "</table>\n";*/
        return $array;
    }
}
?>