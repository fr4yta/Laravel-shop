<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertProductRequest;
use App\Models\Product;
use App\ValueObjects\Cart;
use App\ValueObjects\CartItem;
use http\Exception;
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
        return view('cart.index', [
            'cart' => Session::get('cart', new Cart())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Product  $product
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Product $product) {
        $cart = Session::get('cart', new Cart());
        Session::put('cart', $cart->addItem($product));
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $cart = Session::get('cart', new Cart());
            Session::put('cart', $cart->removeItem($product));
            Session::flash('status', 'Usunieto produkt!');
            return response()->json([
                'status' => 'success'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }
}
