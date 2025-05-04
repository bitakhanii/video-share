@inject('cost', 'App\Support\Cost\Contracts\CostInterface')

<div class="card bg-light">
    <div class="card-body">
        <h4>پرداخت</h4>
        <hr>
        <div class="well">
            <table class='table'>
                @foreach($cost->getSummary() as $description => $price)
                    <tr>
                        <td>{{ $description }}</td>
                        <td>{{ number_format($price) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>مبلغ قابل پرداخت</td>
                    <td>{{ number_format($cost->getTotalCosts()) }}</td>
                </tr>
                <tr>
                    @auth
                        <td>کد تخفیف</td>
                        <td>
                            @if(session()->has('coupon'))
                                <form action="{{ route('coupon.remove') }}" method="GET">
                                    @csrf
                                    <div class="input-group">
                                        <span>{{ session('coupon') }}</span>
                                        <span class="input-group-btn">
                                    <button class="btn btn-primary btn-sm  ml-3" type="submit">حذف</button>
                                </span>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('coupon.apply') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input id='coupon' name='coupon' type="text" class="form-control">
                                        <span class="input-group-btn" style="padding-right: 10px;">
                                    <button id='coupon-apply' class="btn btn-primary  ml-3" type="submit">اعمال</button>
                                </span>
                                    </div>
                                </form>
                            @endif
                        </td>
                    @endauth
                </tr>
            </table>
        </div>
    </div>
</div>
