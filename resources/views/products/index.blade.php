@extends('layout')
@section('content')

    @foreach($products as $product)
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="video-item">
                <div class="thumb">
                    <a href="">
                        <img src="{{ $product->image }}" alt="product image">
                    </a>
                </div>
                <div class="video-info">
                    <a href="" class="title">{{ $product->title }}</a>
                    <p>
                        {{ number_format($product->price) }}
                        <i class="fa fa-check-circle"></i>
                    </p>
                    <a href="{{ route('basket.add', $product) }}" class="btn btn-success">افزودن به سبد خرید</a>
                </div>
            </div>
        </div>
    @endforeach

@endsection
