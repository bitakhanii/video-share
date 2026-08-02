@extends('layout')

@section('content')

    <div class="container py-5">

        <h2 class="fw-bold mb-4">
            <i class="fa fa-shopping-cart me-2"></i>
            سبد خرید
        </h2>

        @if($products->isEmpty())

            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">

                    <i class="fa fa-shopping-basket fa-4x text-secondary mb-4"></i>

                    <h4 class="mb-3">
                        سبد خرید شما خالی است
                    </h4>

                    <p class="text-muted mb-4">
                        هنوز محصولی به سبد خرید اضافه نکرده‌اید.
                    </p>

                    <a href="{{ route('products.index') }}" class="btn btn-primary px-4">
                        مشاهده محصولات
                    </a>

                </div>
            </div>

        @else

            <div class="row">

                {{-- محصولات --}}
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">

                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>محصول</th>

                                    <th width="150">
                                        قیمت
                                    </th>

                                    <th width="180">
                                        تعداد
                                    </th>

                                    <th width="80"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($products as $product)
                                    <tr>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img
                                                    src="{{ $product->image }}"
                                                    width="70"
                                                    height="90"
                                                    class="rounded object-fit-cover me-3">

                                                <div>
                                                    <h6 class="mb-1">
                                                        {{ $product->title }}
                                                    </h6>

                                                    <small class="text-muted">
                                                        {{ $product->category->title }}
                                                    </small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <strong class="text-success">
                                                {{ number_format($product->discountedPrice) }}
                                                تومان
                                            </strong>
                                        </td>

                                        <td>
                                            <form
                                                action="{{ route('basket.update',$product) }}"
                                                method="POST" class="d-flex gap-2">
                                                @csrf

                                                <select
                                                    name="quantity"
                                                    class="form-select form-select-sm">

                                                    @for($i=1;$i<=$product->stock;$i++)
                                                        <option
                                                            value="{{ $i }}"
                                                            @selected($product->quantity==$i)>
                                                            {{ $i }}
                                                        </option>
                                                    @endfor

                                                </select>

                                                <button class="btn btn-primary btn-sm">
                                                    بروزرسانی
                                                </button>

                                            </form>

                                        </td>

                                        <td>
                                            <a
                                                href="{{ route('basket.delete',$product) }}"
                                                class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 sticky-top" style="top:90px;">
                        <div class="card-body">

                            <h5 class="fw-bold mb-4">
                                خلاصه سفارش
                            </h5>

                            @include('basket.summary')

                            <a
                                href="{{ route('basket.checkout.form') }}"
                                class="btn btn-primary w-100 mt-4 py-2">
                                ادامه و ثبت سفارش
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
