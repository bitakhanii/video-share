@extends('layout')
@section('content')

    @include('videos.sidebar')

    <div id="all-output" class="col-md-10 upload">
        <div id="upload">
            <h1>Create Post</h1>

            <x-validation-errors></x-validation-errors>

            <div class="row">
                <!-- upload -->
                <div class="col-md-8">
                    <h1 class="page-title"><span>آپلود</span> فیلم</h1>
                    <form action="{{ route('videos.update', $video->slug) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('labels.name')</label>
                                <input name="name" type="text" class="form-control"
                                       value="{{ old('name', $video->name) }}"
                                       placeholder="@lang('labels.name')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('labels.slug')</label>
                                <input type="text" name="slug" class="form-control"
                                       value="{{ old('slug', $video->slug) }}"
                                       placeholder="@lang('labels.slug')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('labels.file')</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('labels.category')</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id ==
                                        $video->category_id ? 'selected': '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>@lang('labels.description')</label>
                                <textarea class="form-control" name="description" rows="4"
                                          placeholder="@lang('labels.description')">{{ old('description', $video->description) }}</textarea>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="contact_submit" class="btn btn-dm">ذخیره
                                </button>
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
