<?php


namespace App\Dtos\Cart;


class CartDto {
    private $items = [];
    private $totalSum = 0;
    private $totalQuantity = 0;

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return int
     */
    public function getTotalSum()
    {
        return $this->totalSum;
    }

    /**
     * @param int $totalSum
     */
    public function setTotalSum($totalSum)
    {
        $this->totalSum = $totalSum;
    }

    /**
     * @return int
     */
    public function getTotalQuantity()
    {
        return $this->totalQuantity;
    }

    /**
     * @param int $totalQuantity
     */
    public function setTotalQuantity($totalQuantity)
    {
        $this->totalQuantity = $totalQuantity;
    }

    /**
     * @param null $imagePath
     */
    public function incrementTotalQuantity()
    {
        $this->totalQuantity += 1;
    }

    /**
     * @param null $imagePath
     */
    public function incrementTotalSum($price)
    {
        $this->totalSum += $price;
    }


}
