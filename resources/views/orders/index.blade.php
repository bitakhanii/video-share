@extends('layout')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-11">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">سفارش‌های من</h4>
                    <span class="text-muted small">{{ $orders->count() }} سفارش</span>
                </div>

                @if($orders->isEmpty())
                    <div class="card border-0 shadow-sm text-center py-5">
                        <div class="card-body">
                            <p class="text-muted mb-3">هنوز سفارشی ثبت نکرده‌اید.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">
                                مشاهده محصولات
                            </a>
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col">کد سفارش</th>
                                    <th scope="col">مبلغ</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">تاریخ خرید</th>
                                    <th scope="col" class="text-center">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">{{ $order->code }}</span>
                                        </td>
                                        <td>
                                            {{ number_format($order->payment->amount) }}
                                            <span class="text-muted small">تومان</span>
                                        </td>
                                        <td>
                                            @if($order->isPaid())
                                                <span class="badge bg-success">پرداخت شده</span>
                                            @else
                                                <span class="badge bg-danger">پرداخت نشده</span>
                                            @endif
                                        </td>
                                        <td class="text-muted small">
                                            {{ verta($order->created_at)->format('%B %d, %Y') }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                @if(!$order->isPaid())
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('orders.pay', ['order' => $order]) }}">
                                                        پرداخت
                                                    </a>
                                                @endif
                                                <a class="btn btn-outline-secondary btn-sm"
                                                   href="{{ route('orders.invoice', ['order' => $order]) }}">
                                                    دانلود فاکتور
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                {{ $orders->links() }}

            </div>
        </div>
    </div>

@endsection
