<?php

namespace App\Support\Payment\Gateways;

use App\Models\Order;
use Illuminate\Http\Request;

class Saman implements GatewayInterface
{
    private $merchantID;
    private $callback;

    public function __construct()
    {
        $this->merchantID = '123456789';
        $this->callback = route('payment.verify', $this->getName());
    }

    public function pay(Order $order)
    {
        $this->redirectToBank($order);
    }

    public function verify(Request $request)
    {
        /*if (!$request->has('State') || $request->input('State') !== 'OK') {
            return $this->transactionFailed();
        }*/

        $soapClient = new SoapClient('https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL');
        $response = $soapClient->verifyTransaction($request->RefNum, $this->merchantID);

        dd($response);

        $order = $this->getOrder($request);

        $this->transactionSuccess($order, $request->RefNum);
    }

    public function getName(): string
    {
        return 'saman';
    }

    private function redirectToBank($order)
    {
        echo "<form id='samanPayment' action='https://sep.shaparak.ir/payment.aspx' method='post'>
    <input type='hidden' name='Amount' value='{$order->amount}' />
    <input type='hidden' name='ResNum' value='{$order->code}' />
    <input type='hidden' name='RedirectURL' value='{$this->callback}' />
    <input type='hidden' name='MID' value='{$this->merchantID}' />
    <script>document.forms['samanPayment'].submit()</script>
</form>";
    }

    private function transactionFailed()
    {
        return [
            'status' => self::TRANSACTION_FAILED,
        ];
    }

    private function transactionSuccess($order, $refNum)
    {
        return [
            'status' => self::TRANSACTION_SUCCESS,
            'order' => $order,
            'refNum' => $refNum,
        ];
    }

    private function getOrder($request)
    {
        return Order::query()->where('code', '=', $request->ResNum)->firstOrFail();
    }
}
