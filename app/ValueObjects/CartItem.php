<?php


namespace App\ValueObjects;

use App\Models\Product;

class CartItem {
    private $productId;
    private $name;
    private $price;
    private $imagePath = null;
    private $quantity = 0;

    /**
     * CartItem constructor.
     * @param Product $product
     * @param $quantity
     */
    public function __construct(Product $product, $quantity = 1)
    {
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->imagePath = $product->image_path;
        $this->quantity += $quantity;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return null
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @return null
     */
    public function getImage() {
        if(!is_null($this->getImagePath())) {
            return asset('storage/' . $this->getImagePath());
        } else {
            return config("shop.defaultImg");
        }
    }

    public function getSum() {
        return $this->price * $this->quantity;
    }

    /**
     * @return null
     */
    public function addQuantity(Product $product)
    {
        return new CartItem($product, ++$this->quantity);
    }


}
