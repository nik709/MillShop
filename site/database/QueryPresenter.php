<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 12.11.2016
 * Time: 15:00
 */
interface QueryPresenter{

    public function getItemById($id);

    public function getItemsBySizes($sizes);

    public function getItemsByColor($color);

    public function getItemsByCriteria($criteria);

    public function getMaxPrice();

    public function getMinPrice();

    public function drawItemHolders();

    public function drawColors();

    public function drawSizes();
}
?>