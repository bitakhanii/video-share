<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Basket\Basket;
use App\Support\Payment\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BasketController extends Controller
{
    private Basket $basket;
    private Transaction $transaction;

    public function __construct(Basket $basket, Transaction $transaction)
    {
        $this->basket = $basket;
        $this->transaction = $transaction;
    }

    public function addToBasket(Product $product): RedirectResponse
    {
        try {
            $this->basket->add($product, 1);
        } catch (QuantityExceededException $e) {
            return error_redirect('back', 'basket.stock', 'product');
        }
        return success_redirect('back', 'basket.add', 'product');
        //session()->forget('cart');
    }

    public function index()
    {
        $products = $this->basket->all();
        return view('basket.index', compact('products'));
    }

    /**
     * @throws QuantityExceededException
     */
    public function updateQuantity(Request $request, Product $product): RedirectResponse
    {
        $this->basket->update($product, $request->quantity);
        return back();
    }

    public function delete(Product $product): RedirectResponse
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

    /**
     * @throws \Throwable
     */
    public function checkout(Request $request): RedirectResponse
    {
        $this->validateMethod($request);
        try {
            $order = $this->transaction->checkout();
        } catch (\Exception $e) {
            return error_redirect('basket.checkout.form', 'problem');
        }

        return success_redirect('products.index', 'register', 'order');
    }

    private function validateMethod(Request $request): void
    {
        $request->validate([
            'method' => ['required', 'in:online,cash,cart'],
            'gateway' => ['required_if:method,online', 'in:saman,pasargad'],
        ], [
            'method.required' => 'روش پرداخت خود را انتخاب کنید.',
            'gateway.required_if' => 'درگاه پرداخت موردنظر خود را انتخاب کنید.',
            'method.in' => 'روش پرداخت نامعتبر است.',
            'gateway.in' => 'درگاه پرداخت نامعتبر است..',
        ]);
    }
}
