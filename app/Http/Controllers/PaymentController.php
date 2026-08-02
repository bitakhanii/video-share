<?php

namespace App\Http\Controllers;

use App\Support\Payment\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private Transaction $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function verify(): RedirectResponse
    {
        return $this->transaction->verify()
            ? $this->sendSuccessResponse()
            : $this->sendFailedResponse();
    }

    private function sendFailedResponse(): RedirectResponse
    {
        return error_redirect('products.index', 'pay');
    }

    private function sendSuccessResponse(): RedirectResponse
    {
        return success_redirect('index', 'pay', 'order');
    }
}
