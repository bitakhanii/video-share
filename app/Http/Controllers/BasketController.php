<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Basket\Basket;
use App\Support\Payment\Transaction;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private $basket;
    private $transaction;

    public function __construct(Basket $basket, Transaction $transaction)
    {
        $this->basket = $basket;
        $this->transaction = $transaction;
    }

    public function addToBasket(Product $product)
    {
        try {
            $this->basket->add($product, 1);
            return back()->with([
                'alert' => __('alerts.success.basket.add', ['attribute' => $product->title]),
                'alert-type' => 'success',
            ]);
        } catch (QuantityExceededException $e) {
            return back()->with([
                'alert' => __('alerts.danger.basket.stock'),
                'alert-type' => 'danger',
            ]);
        }
        //session()->forget('cart');
    }

    public function index()
    {
        $products = $this->basket->all();
        return view('basket.index', compact('products'));
    }

    public function updateQuantity(Request $request, Product $product)
    {
        $this->basket->update($product, $request->quantity);
        return back();
    }

    public function delete(Product $product)
    {
        $this->basket->delete($product);
        return back();
    }

    public function checkoutForm()
    {
        if (!session()->has('cart')) {
            abort(403);
        }
        return view('basket.checkout');
    }

    public function checkout(Request $request)
    {
        $this->validateMethod($request);
        $order = $this->transaction->checkout();
        return redirect()->route('products.index')->with(['alert' => __('alerts.success.register', ['attribute' => 'سفارش شما', 'id' => $order->id]), 'alert-type' => 'success']);
    }

    private function validateMethod(Request $request)
    {
        $request->validate([
            'method' => ['required'],
            'gateway' => ['required_if:method,online'],
        ], [
            'method' => 'روش پرداخت خود را انتخاب کنید.',
            'gateway' => 'درگاه پرداخت موردنظر خود را انتخاب کنید.',
        ]);
    }
}
