<?php

namespace App\Http\Controllers;

use App\Dtos\Cart\CartDto;
use App\Dtos\Cart\CartItemDto;
use App\Http\Requests\UpsertProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Product  $product
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Product $product) {
        $cart = Session::get('cart', new CartDto());
        $items = $cart->getItems();

        if(Arr::exists($items, $product->id)) {
            $items[$product->id]->incrementQuantity();
        } else {
            $cartItemDto = $this->getCartItemDto($product);
            $items[$product->id] = $cartItemDto;
        }
        $cart->setItems($items);
        $cart->incrementTotalQuantity();
        $cart->incrementTotalSum($product->price);

        Session::put('cart', $cart);

        return response()->json([
            'status' => 'success',
        ]);
    }

    private function getCartItemDto(Product $product) {
        $cartItemDto = new CartItemDto();
        $cartItemDto->setProductId($product->id);
        $cartItemDto->setName($product->name);
        $cartItemDto->setPrice($product->price);
        $cartItemDto->setQuantity(1);
        $cartItemDto->setQuantity($product->image_path);
        return $cartItemDto;
    }
}
