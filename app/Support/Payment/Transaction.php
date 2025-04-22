<?php

namespace App\Support\Payment;

use App\Events\OrderRegistered;
use App\Models\Order;
use App\Models\Payment;
use App\Support\Basket\Basket;
use App\Support\Payment\Gateways\GatewayInterface;
use App\Support\Payment\Gateways\Pasargad;
use App\Support\Payment\Gateways\Saman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Transaction
{

    private $requset;
    private $basket;

    public function __construct(Request $request, Basket $basket)
    {
        $this->requset = $request;
        $this->basket = $basket;
    }

    public function checkout()
    {
        /* برای اینکه اگه به هر دلیلی خطایی توی عملیات های ساخت سفارش و ساخت پرداخت افتاد اگه ذخیره شده بود چیزی توی دیتابیس حذف بشه و همه چی rollback کنه */

        DB::beginTransaction();
        /* این شروع میکنه این کار رو. */

        try {
            $order = $this->makeOrder();
            $payment = $this->makePayment($order);

            DB::commit();
            /* این باعث میشه که اگه عملیات کلا با موفقیت انجام شد کارها طبق روال عادی انجام بشن و سطور در دیتابیس ذخیره بشن. */
        } catch (\Exception $e) {
            DB::rollBack();
            /* این باعث میشه که اگه خطایی رخ داد اگه چیزی توی دیتابیس ذخیره شد پاک بشه. */
            return null;
        }

        if ($payment->isOnline()) {
            return $this->gatewayFactory()->pay($order);
        }

        $this->completeOrder($order);
        return $order;
    }

    public function verify()
    {
        $result = $this->gatewayFactory()->verify($this->requset);

        if ($result == GatewayInterface::TRANSACTION_FAILED) {
            return false;
        }

        $result['order']->payment->confirm($result['refNum'], $result['gateway']);

        $this->completeOrder($result['order']);
        return true;
    }

    private function makeOrder()
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'amount' => $this->basket->subTotal() + 50000,
            'code' => bin2hex(Str::random(16)),
        ]);

        $order->products()->attach($this->products());

        return $order;
    }

    private function makePayment($order)
    {
        return Payment::create([
            'order_id' => $order->id,
            'method' => $this->requset->method,
            'gateway' => $this->requset->gateway,
            'amount' => $order->amount,
        ]);
    }

    private function products()
    {
        foreach ($this->basket->all() as $product) {
            $products[$product->id] = ['quantity' => $product->quantity];
        }

        return $products;
    }

    private function gatewayFactory()
    {
        $gateway = [
            'saman' => Saman::class,
            'pasargad' => Pasargad::class,
        ][$this->requset->gateway];

        return resolve($gateway);
    }

    private function normalizeQuantity($order)
    {
        foreach ($order->products as $product) {
            $product->decrementStock($product->pivot->quantity);
        }
    }

    private function completeOrder($order)
    {
        $this->normalizeQuantity($order);

        event(new OrderRegistered($order));

        $this->basket->clear();
    }

}
