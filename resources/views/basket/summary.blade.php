@inject('basket', 'App\Support\Basket\Basket')
<div class="card bg-light">
    <div class="card-body">
        <h4>پرداخت</h4>
        <hr>
        <div class="well">
            <table class='table'>
                <tr>
                    <td>مبلغ کل خرید</td>
                    <td>{{ number_format($basket->subTotal()) }}</td>
                </tr>
                <tr>
                    <td>هزینه حمل</td>
                    <td>{{ number_format(50000) }}</td>
                </tr>
                <tr>
                    <td>مبلغ قابل پرداخت</td>
                    <td>{{ number_format($basket->subTotal() + 50000) }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
