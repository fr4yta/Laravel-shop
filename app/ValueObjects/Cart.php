<?php


namespace App\ValueObjects;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Cart {
    private $items;

    /**
     * @param Collection $items
     */
    public function __construct(Collection $items = null)
    {
        $this->items = $items ?? Collection::empty();
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    public function hasItems() {
        return $this->items->isNotEmpty();
    }

    /**
     * @return array
     */
    public function getSum()
    {
        return $this->items->sum(function ($item) {
            return $item->getSum();
        });
    }

    /**
     * @return array
     */
    public function getQuantity()
    {
        return $this->items->sum(function ($item) {
            return $item->getQuantity();
        });
    }

    public function addItem(Product $product) {
        $items = $this->items;
        $item = $items->first($this->isProductIdSameAsItemProduct($product));
        if(!is_null($item)) {
            $items = $this->removeItemFromCollection($items, $product);
            $newItem = $item->addQuantity($product);
        } else {
            $newItem = new CartItem($product);
        }
        $items->add($newItem);
        return new Cart($items);
    }

    public function removeItem(Product $product) {
        $items = $this->removeItemFromCollection($this->items, $product);
        return new Cart($items);
    }

    private function removeItemFromCollection(Collection $items, Product $product)
    {
        return $items->reject($this->isProductIdSameAsItemProduct($product));
    }

    private function isProductIdSameAsItemProduct(Product $product)
    {
        return function ($item) use ($product) {
            return $product->id == $item->getProductId();
        };
    }


}
