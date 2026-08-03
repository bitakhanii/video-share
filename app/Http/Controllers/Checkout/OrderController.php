<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Support\Payment\Transaction;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    private Transaction $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(5);
        return view('orders.index', compact(['orders']));
    }

    public function downloadInvoice(Order $order): StreamedResponse
    {
        return $order->downloadInvoice();
    }

    public function pay(Order $order)
    {
        $this->transaction->orderPay($order);
    }

}
