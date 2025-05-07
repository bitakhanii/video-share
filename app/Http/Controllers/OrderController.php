<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Payment\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        $orders = auth()->user()->orders;
        return view('orders.index', compact(['orders']));
    }

    public function downloadInvoice(Order $order)
    {
        // نام دیسک و مسیر نسبی فایل
        $filePath = 'invoices/order' . $order->id . '.pdf';

        // بررسی وجود فایل
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        } else {
            return response()->json(['message' => 'فاکتور پیدا نشد.'], 404);
        }
    }

    //or

    /*public function downloadInvoice($orderId)
    {
        // مسیر فایل PDF فاکتور
        $filePath = storage_path('app/public/invoices/order' . $orderId . '.pdf');

        // بررسی وجود فایل
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json(['message' => 'فاکتور پیدا نشد.'], 404);
        }
    }*/

    public function pay(Order $order)
    {
        $this->transaction->orderPay($order);
    }

}
