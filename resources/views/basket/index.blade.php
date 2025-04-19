@extends('layout')

@section('content')

    <div class="justify-content-center mt-5">

        <div class="row">
            <div class="col-md-7 card bg-light mr-3">
                <div class="card-body well">
                    @if($products->isEmpty())
                        <p>سبد خرید شما خالی می‌باشد. شما می‌توانید با رفتن به صفحه
                            <a href="{{ route('products.index') }}">محصولات</a>
                            خرید خود را آغاز کنید.
                        </p>
                    @else
                        <table class="table">
                            <thead class="text-right">
                            <tr>
                                <th>نام محصول</th>
                                <th>قیمت محصول</th>
                                <th>تعداد</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>
                                        <form action="{{ route('basket.update', $product) }}" method="POST"
                                              class="form-inline">
                                            @csrf
                                            <select name="quantity" class="form-control input-sm">
                                                @for($i = 1; $i <= $product->stock; $i++)
                                                    <option
                                                        {{ $product->quantity == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <button class="btn btn-primary btn-sm">اعمال</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('basket.delete', $product) }}" class="text-danger"><i
                                                class="fa fa-times small"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                @include('basket.summary')
                <a href="{{ route('basket.checkout.form') }}" class="btn mt-4  btn-primary btn-lg w-100 d-block">ادامه و ثبت سفارش</a>
            </div>
        </div>
    </div>

@endsection

