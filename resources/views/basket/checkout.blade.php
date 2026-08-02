@extends('layout')

@section('content')

    <div class="container py-4">

        <div class="row g-4">

            <div class="col-md-8">

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold">
                        اطلاعات کاربر
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">گیرنده : {{ auth()->user()->name }}</li>
                            <li class="list-group-item">آدرس : {{ auth()->user()->address }}</li>
                            <li class="list-group-item">شماره‌تماس : {{ auth()->user()->phone_number }}</li>
                        </ul>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold">
                        روش پرداخت
                    </div>
                    <div class="card-body">

                        <x-validation-errors></x-validation-errors>

                        <form action="{{ route('basket.checkout') }}" id='checkout-form' method="post">
                            @csrf
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item py-3">
                                    <div class="d-flex align-items-center flex-wrap gap-3 mb-2">
                                        <div class="form-check">
                                            <input type="radio" id="online" value="online" name="method"
                                                   class="form-check-input" checked>
                                            <label class="form-check-label fw-semibold" for="online">
                                                پرداخت آنلاین
                                            </label>
                                        </div>

                                        <select name='gateway' class="form-select w-auto">
                                            <option value="saman">سامان</option>
                                            <option value="pasargad">پاسارگاد</option>
                                        </select>
                                    </div>

                                    <p class="text-muted small mb-0">همین حالا و بدون دردسر پرداخت خود را انجام دهید.</p>
                                </li>

                                <li class="list-group-item py-3">
                                    <div class="form-check mb-2">
                                        <input type="radio" id="cash" value="cash" name="method"
                                               class="form-check-input">
                                        <label class="form-check-label fw-semibold" for="cash">
                                            پرداخت نقدی
                                        </label>
                                    </div>

                                    <p class='text-muted small mb-0'>
                                        در این روش شما میتونید درب منزل خود مبلغ را پرداخت نمایید
                                    </p>
                                </li>

                                <li class="list-group-item py-3">
                                    <div class="form-check mb-2">
                                        <input type="radio" id="cart" value="cart" name="method"
                                               class="form-check-input">
                                        <label class="form-check-label fw-semibold" for="cart">
                                            کارت به کارت
                                        </label>
                                    </div>

                                    <p class='text-muted small mb-0'>
                                        لطفا مبلغ را به شماره کارت ۵۵۵۵−۵۵۵۵−۵۵۵۵−۵۵۵۵ واریز نمایدد و کد پیگیری را به
                                        همکاران ما اطلاع دهید
                                    </p>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                @include('basket.summary')
                <a onclick="event.preventDefault();document.getElementById('checkout-form').submit();"
                   class="btn btn-danger d-block w-100 py-2 mt-3">پرداخت</a>
            </div>

        </div>

    </div>

@endsection
