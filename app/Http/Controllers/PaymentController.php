<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use App\ValueObjects\Cart;
use Devpark\Transfers24\Requests\Transfers24;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
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
     * Update status of the payment.
     *
     */
    public function status(Request $request) {
        $response = $this->transfer24->receive($request);
        $payment = Payment::where('session_id', $response->getSessionId())->firstOrFail();

        if(!is_null($payment)) {
            if ($response->isSuccess()) {
                $payment->status = PaymentStatus::SUCCESS;
            } else {
                $payment->status = PaymentStatus::FAIL;
                $payment->error_code = $response->getErrorCode();
                $payment->error_description = json_encode($response->getErrorDescription());
            }
            $payment->save();
        }
    }
}
