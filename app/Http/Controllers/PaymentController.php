<?php

namespace App\Http\Controllers;

use App\Support\Payment\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function verify()
    {
        return $this->transaction->verify()
            ? $this->sendSuccessResponse()
            : $this->sendFailedResponse();
    }

    private function sendFailedResponse()
    {
        return redirect()->route('index')->with(['alert' => __('alerts.danger.pay'), 'alert-type' => 'danger']);
    }

    private function sendSuccessResponse()
    {
        return redirect()->route('index')->with([
            'alert' => __('alerts.success.pay', ['attribute' => 'سفارش شما']),
            'alert-type' => 'success',
        ]);
    }
}
