<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use App\ValueObjects\Cart;
use Devpark\Transfers24\Requests\Transfers24;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    private $transfer24;

    /**
     * OrderController constructor.
     * @param $transfer24
     */
    public function __construct(Transfers24 $transfer24) {
        $this->transfer24 = $transfer24;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('orders.index', [
            'orders' => Order::where('user_id', Auth::id())->paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store() {
        $cart = Session::get('cart', new Cart());
        if($cart->hasItems()) {
            $order = new Order();
            $order->quantity = $cart->getQuantity();
            $order->price = $cart->getSum();
            $order->user_id = Auth::id();
            $order->save();

            $productIds = $cart->getItems()->map(function ($item) {
                return ['product_id' => $item->getProductId()];
            });
            $order->products()->attach($productIds);

            return $this->paymentTransaction($order);
        }
        return back();
    }

    private function paymentTransaction(Order $order) {
        $payment = new Payment();
        $payment->order_id = $order->id;

        $this->transfer24->setEmail(Auth::user()->email)->setAmount($order->price);

        try {
            $response = $this->transfer24->init();
            if($response->isSuccess()) {
                $payment->status = PaymentStatus::IN_PROGRESS;
                $payment->session_id = $response->getSessionId();
                $payment->save();

                Session::put('cart', new Cart());

                return redirect($this->transfer24->execute($response->getToken(), false));
            } else {
                $payment->status = PaymentStatus::FAIL;
                $payment->error_code = $response->getErrorCode();
                $payment->error_description = json_encode($response->getErrorDescription());
                $payment->save();

                return back()->with('warning', 'Ups... Coś poszło nie tak!');
            }
        } catch (RequestException $e) {
            Log::error("Błąd transakcji", ['error' => $e]);
            return back()->with('warning', 'Ups... Coś poszło nie tak!');
        }
    }
}
