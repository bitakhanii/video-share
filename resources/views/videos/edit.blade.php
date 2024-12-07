@extends('layout')
@section('content')
    <div class="col-md-2 no-padding-left hidden-sm hidden-xs">
        <div class="left-sidebar">
            <div id="sidebar-stick">
                <ul class="menu-sidebar">
                    <li><a href="01-home.html"><i class="fa fa-home"></i>خانه</a></li>
                    <li><a href="#"><i class="fa fa-bolt"></i>رندوم</a></li>
                    <li><a href="14-history.html"><i class="fa fa-clock-o"></i>تاریخچه</a></li>
                    <li><a href="11-blog.html"><i class="fa fa-file-text"></i>وبلاگ</a></li>
                    <li><a href="10-upload.html"><i class="fa fa-upload"></i>آپلود</a></li>
                </ul>
                <ul class="menu-sidebar">
                    <li><a href="#"><i class="fa fa-edit"></i>ویرایش پروفایل</a></li>
                    <li><a href="#"><i class="fa fa-sign-out"></i>خروج</a></li>
                </ul>
                <ul class="menu-sidebar">
                    <li><a href="#"><i class="fa fa-gear"></i>تنظیمات</a></li>
                    <li><a href="#"><i class="fa fa-question-circle"></i>راهنما</a></li>
                    <li><a href="#"><i class="fa fa-send-o"></i>ارسال بازخورد</a></li>
                </ul>
            </div><!-- // sidebar-stick -->
            <div class="clear"></div>
        </div><!-- // left-sidebar -->
    </div><!-- // col-md-2 -->



    <div id="all-output" class="col-md-10 upload">
        <div id="upload">
            <h1>Create Post</h1>

            <x-validation-errors></x-validation-errors>

            <div class="row">
                <!-- upload -->
                <div class="col-md-8">
                    <h1 class="page-title"><span>آپلود</span> فیلم</h1>
                    <form action="{{ route('videos.update', $video->slug) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>@lang('labels.name')</label>
                                <input name="name" type="text" class="form-control" value="{{ old('name', $video->name) }}" placeholder="@lang('labels.name')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('labels.length')</label>
                                <input type="text" name="length" class="form-control" value="{{ old('length', $video->length) }}" placeholder="@lang('labels.length')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('labels.slug')</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug', $video->slug) }}" placeholder="@lang('labels.slug')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('labels.url')</label>
                                <input type="text" name="url" class="form-control" value="{{ old('url', $video->url) }}" placeholder="@lang('labels.url')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('labels.thumbnail')</label>
                                <input type="text" name="thumbnail" class="form-control" value="{{ old('thumbnail', $video->thumbnail) }}" placeholder="@lang('labels.thumbnail')">
                            </div>
                            <div class="col-md-6">
                                <label>@lang('labels.category')</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $video->category_id? 'selected': '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label>@lang('labels.description')</label>
                                <textarea class="form-control" name="description" rows="4"
                                          placeholder="@lang('labels.description')">{{ old('description', $video->description) }}</textarea>
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
