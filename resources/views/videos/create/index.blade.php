@extends('layout')

@section('content')

    <div class="container py-5">

        <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="fa fa-arrow-right ms-1"></i> بازگشت به صفحه اصلی
        </a>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="card border-0 shadow-sm">
                    <div class="row g-0">

                        <!-- Form -->
                        <div class="col-md-8">
                            <div class="card-body p-4 p-md-5">

                                <h1 class="h3 fw-bold mb-4">
                                    <span class="text-danger">آپلود</span> فیلم
                                </h1>

                                {{--<x-validation-errors></x-validation-errors>--}}

                                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">@lang('labels.name')</label>
                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{
                                            old('name') }}" placeholder="@lang('labels.name')">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">@lang('labels.slug')</label>
                                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{
                                            old('slug') }}" placeholder="@lang('labels.slug')">
                                            <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">@lang('labels.file')</label>
                                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">@lang('labels.category')</label>
                                            <select class="form-select" id="category" name="category_id">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">@lang('labels.description')</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5"
                                                      placeholder="@lang('labels.description')">{{ old('description') }}</textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                        <div class="col-md-5">
                                            <button type="submit" id="contact_submit" class="btn btn-danger w-100 py-2">ذخیره</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div><!-- // col-md-8 -->

                        <!-- Promo Image -->
                        <div class="col-md-4 d-none d-md-block">
                            <a href="#" class="d-block h-100">
                                <img src="{{ asset('img/upload-adv.png') }}" alt=""
                                     class="w-100 h-100 rounded-end-3"
                                     style="object-fit: cover;">
                            </a>
                        </div><!-- // col-md-4 -->

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
