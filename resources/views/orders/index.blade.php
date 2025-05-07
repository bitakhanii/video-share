@extends('layout')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="card col-md-10 ">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">کد سفارش</th>
                    <th scope="col">مبلغ</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">تاریخ خرید</th>
                    <th scope="col">عملیات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->code }}</th>
                        <td>{{ $order->payment->amount }}</td>
                        @if($order->isPaid())
                            <td>پرداخت شده</td>
                        @else
                            <td>پرداخت نشده</td>
                        @endif
                        <td>{{ $order->created_at }}</td>
                        <td colspan=4>
                            @if(!$order->isPaid())
                                <a class="btn btn-primary btn-sm" href="{{ route('orders.pay', ['order' => $order])
                                }}">پرداخت</a>
                            @endif
                            <a class="btn btn-primary btn-sm" href="{{ route('orders.invoice', ['order' => $order])
                            }}">دانلود فاکتور</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
