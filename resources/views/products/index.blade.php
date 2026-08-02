@extends('layout')
@section('content')

    <style>

        .card {
            border-radius: 14px;
            overflow: hidden;
            transition: .2s;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .product-image {
            height: 320px;
            overflow: hidden;
            background: #f8f9fa;
        }

        .product-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
            display: block !important;
        }

        .product-title {
            height: 48px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .product-desc {
            height: 60px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

    </style>

    <div class="container py-5">

        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold">محصولات</h2>
                <p class="text-muted">جدیدترین محصولات فروشگاه</p>
            </div>
        </div>

        <div class="row g-4">

            @foreach($products as $product)

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="product-image">
                            <img
                                src="{{ $product->image }}"
                                alt="{{ $product->title }}"
                                class="card-img-top">
                        </div>

                        <div class="card-body d-flex flex-column">

                            <span class="badge bg-secondary align-self-start mb-2">
                                {{ $product->category->title }}
                            </span>

                            <h5 class="product-title mb-2">
                                {{ $product->title }}
                            </h5>

                            <p class="text-muted small product-desc mb-3">
                                {{ \Illuminate\Support\Str::limit($product->description, 70) }}
                            </p>

                            <div class="mt-auto">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <span class="fw-bold text-success">
                                        {{ number_format($product->price) }} تومان
                                    </span>

                                    @if($product->stock > 0)
                                        <span class="badge bg-success">موجود</span>
                                    @else
                                        <span class="badge bg-danger">ناموجود</span>
                                    @endif

                                </div>

                                <div class="d-grid gap-2">

                                    <a href=""
                                       class="btn btn-outline-primary">
                                        مشاهده محصول
                                    </a>

                                    @if($product->stock > 0)
                                        <form action="{{ route('basket.add', $product) }}" method="POST">
                                            @csrf

                                            <button class="btn btn-primary w-100">
                                                افزودن به سبد خرید
                                            </button>
                                        </form>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        {{--<div class="mt-5">
            {{ $products->links() }}
        </div>--}}

    </div>

@endsection
