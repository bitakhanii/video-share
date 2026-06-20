@extends('layout')

@section('content')

    @include('videos.sidebar')

    <div id="all-output" class="col-md-10 upload">
        <div id="upload">
            <h1>Create Post</h1>

            {{--<x-validation-errors></x-validation-errors>--}}

            <div class="row">
                <!-- upload -->
                <div class="col-md-8">
                    <h1 class="page-title"><span>آپلود</span> فیلم</h1>
                    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <label>@lang('labels.name')</label>
                                <input name="name" type="text" class="form-control @error('name')
                                 is-invalid @enderror" value="{{
                                old('name') }}" placeholder="@lang('labels.name')">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="col-md-6">
                                <label>@lang('labels.slug')</label>
                                <input type="text" name="slug" class="form-control @error('slug')
                                 is-invalid @enderror" value="{{
                                old('slug') }}" placeholder="@lang('labels.slug')">
                                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            </div>

                            <div class="col-md-6">
                                <label>@lang('labels.file')</label>
                                <input type="file" name="file" class="form-control @error('file')
                                 is-invalid @enderror">
                                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            </div>

                            <div class="col-md-6">
                                <label>@lang('labels.category')</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                            </div>

                            <div class="col-md-12">
                                <label>@lang('labels.description')</label>
                                <textarea class="form-control @error('description')
                                 is-invalid @enderror" name="description" rows="4"
                                          placeholder="@lang('labels.description')">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="col-md-2">
                                <button type="submit" id="contact_submit" class="btn btn-dm">ذخیره</button>
                            </div>

                        </div>
                    </form>
                </div><!-- // col-md-8 -->

                <div class="col-md-4">
                    <a href="#"><img src="{{ asset('img/upload-adv.png') }}" alt=""></a>
                </div><!-- // col-md-8 -->
                <!-- // upload -->
            </div><!-- // row -->
        </div><!-- // upload -->
    </div>
@endsection
