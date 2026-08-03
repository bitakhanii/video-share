<?php

namespace App\Support\Payment;

use App\Events\OrderRegistered;
use App\Models\Order;
use App\Models\Payment;
use App\Support\Basket\Basket;
use App\Support\Cost\Contracts\CostInterface;
use App\Support\Payment\Gateways\GatewayInterface;
use App\Support\Payment\Gateways\Pasargad;
use App\Support\Payment\Gateways\Saman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Transaction
{
    private Request $request;
    private Basket $basket;
    private CostInterface $cost;

    public function __construct(Request $request, Basket $basket, CostInterface $cost)
    {
        $this->request = $request;
        $this->basket = $basket;
        $this->cost = $cost;
    }

    /**
     * @throws \Throwable
     */
    public function checkout()
    {
        DB::beginTransaction();

        try {
            $order = $this->makeOrder();
            $order->generateInvoice();
            $payment = $this->makePayment($order);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            throw $e;
        }

        if ($payment->isOnline()) {
            $this->gatewayFactory()->pay($order, $this->cost->getTotalCosts());
            exit;
        }

        $this->completeOrder($order);
        return $order;
    }

    public function verify(): bool
    {
        $result = $this->gatewayFactory()->verify($this->request);

        if ($result['status'] == GatewayInterface::TRANSACTION_FAILED) {
            return false;
        }

        $result['orders']->payment->confirm($result['refNum'], $result['gateway']);

        $this->completeOrder($result['orders']);
        return true;
    }

    public function orderPay(Order $order): void
    {
        $this->gatewayFactory()->pay($order, $order->payment->amount);
    }

    private function makeOrder(): Order
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'amount' => $this->basket->subTotal(),
            'code' => bin2hex(Str::random(16)),
        ]);

        $order->products()->attach($this->products());

        return $order;
    }

    private function makePayment($order): Payment
    {
        return Payment::create([
            'order_id' => $order->id,
            'method' => $this->request->method,
            'gateway' => $this->request->gateway,
            'amount' => $this->cost->getTotalCosts(),
        ]);
    }

    private function products(): array
    {
        foreach ($this->basket->all() as $product) {
            $products[$product->id] = ['quantity' => $product->quantity];
        }

        return $products;
    }

    private function gatewayFactory()
    {
        if (!$this->request->has('gateway')) return resolve(Saman::class);

        $gateway = [
            'saman' => Saman::class,
            'pasargad' => Pasargad::class,
        ][$this->request->gateway];

        return resolve($gateway);
    }

    private function normalizeQuantity($order): void
    {
        foreach ($order->products as $product) {
            $product->decrementStock($product->pivot->quantity);
        }
    }

    private function completeOrder($order): void
    {
        $this->normalizeQuantity($order);

        event(new OrderRegistered($order));

        session()->forget('coupon');

        $this->basket->clear();
    }

}
