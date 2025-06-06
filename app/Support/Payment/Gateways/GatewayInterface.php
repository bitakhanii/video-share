<?php

namespace App\Support\Payment\Gateways;

use App\Models\Order;
use Illuminate\Http\Request;

interface GatewayInterface
{
    const TRANSACTION_SUCCESS = 'transaction.success';
    const TRANSACTION_FAILED = 'transaction.failed';
    public function pay(Order $order, int $amount);

    public function verify(Request $request);

    public function getName():string;
}
