@extends('layout')
@section('content')

    <form class="mt-5" action="#" method="get">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="inputCity">ترتیب بر اساس</label>
                <select class="form-control" name="sortBy">
                    <option value="created_at" {{ request()->query('sortBy') == 'created_at' ? 'selected' : '' }}>جدیدترین</option>
                    <option value="like" {{ request()->query('sortBy') == 'like' ? 'selected' : '' }}>محبوب‌‌ترین</option>
                    <option value="length" {{ request()->query('sortBy') == 'length' ? 'selected' : '' }}>مدت زمان ویدئو</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="inputState">مدت زمان</label>
                <select id="inputState" class="form-control" name="length">
                    <option value="" {{ request()->query('length') == null ? 'selected' : '' }}>همه</option>
                    <option value="1" {{ request()->query('length') == 1 ? 'selected' : '' }}>کمتر از ۱۰ دقیقه</option>
                    <option value="2" {{ request()->query('length') == 2 ? 'selected' : '' }}>۱۰ تا ۳۰ دقیقه</option>
                    <option value="3" {{ request()->query('length') == 3 ? 'selected' : '' }}>بیشتر از ۳۰ دقیقه</option>
                </select>
            </div>

            <input type="hidden", name="q" value="{{ request()->query('q') }}">

            <div class="form-group col-md-3" style="margin-top: 29px;">
                <button type="submit" class="btn btn-primary">فیلتر</button>
            </div>
        </div>
    </form>

    <h1 class="new-video-title"><i class="fa fa-bolt"></i>{{ $title }}</h1>
    <div class="row">
        @foreach($videos as $video)
            <x-video-box :video="$video"></x-video-box>
        @endforeach
    </div>

    <div class="text-center" dir="ltr">
        {{ $videos->links() }}
    </div>

@endsection
