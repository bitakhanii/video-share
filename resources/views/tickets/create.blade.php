@extends('layout')

@section('title', 'ثبت تیکت')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-header bg-dark text-white text-center py-4 rounded-top-4">
                        <h3 class="mb-1">📩 ثبت تیکت جدید</h3>
                        <p class="mb-0 text-light small">
                            سوال، مشکل یا درخواست خود را برای ما ارسال کنید.
                        </p>
                    </div>

                    <div class="card-body p-4">

                        <x-validation-errors class="mb-4"/>

                        <form action="{{ route('tickets.store') }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    placeholder="عنوان تیکت را وارد کنید">
                            </div>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">بخش</label>

                                    <select class="form-select"
                                            id="department"
                                            name="department">

                                        <option value="0">فنی</option>
                                        <option value="1">مالی</option>
                                        <option value="2">پشتیبانی</option>

                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="priority" class="form-label">اولویت</label>

                                    <select class="form-select"
                                            id="priority"
                                            name="priority">

                                        <option value="0">پایین</option>
                                        <option value="1">متوسط</option>
                                        <option value="2">بالا</option>

                                    </select>
                                </div>

                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">
                                    متن پیام
                                </label>

                                <textarea
                                    class="form-control"
                                    id="content"
                                    name="content"
                                    rows="7"
                                    placeholder="مشکل یا درخواست خود را با جزئیات بنویسید...">{{ old('content') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="file" class="form-label">
                                    فایل پیوست <span class="text-muted">(اختیاری)</span>
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="file"
                                    name="file">
                            </div>

                            <div class="d-grid">
                                <button type="submit"
                                        class="btn btn-dark btn-lg">
                                    ارسال تیکت
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
