<?php

/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 30.10.2016
 * Time: 20:50
 */
class DBConnection
{
    private $link;
    private $query;
    private $result;

    public function openConnection(){
        $this->link = mysqli_connect('localhost:3306', 'root', 'root', 'millshop');
        if (!$this->link) {
            die('Ошибка соединения: ' . mysqli_error($this->link));
        }
        echo 'Соединение успешно установлено';
        mysqli_select_db($this->link, 'MillShop') or die('Не удалось выбрать базу данных');
    }

    public function execueQuery(){
        $this->result = mysqli_query($this->link, $this->query) or die('Запрос не удался: ' .mysqli_error($this->link));
    }

    /**
     * @param mixed $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function showResult(){
        echo "<table>\n";
        while ($line = mysqli_fetch_array($this->result, MYSQLI_ASSOC)) {
            echo "\t<tr>\n";
            foreach ($line as $col_value) {
                echo "\t\t<td>$col_value</td>\n";
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
}
?>