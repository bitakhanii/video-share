@extends('layout')
@section('content')

    @include('videos.index.sort')

    <h1 class="new-video-title"><i class="fa fa-bolt"></i>
        {{ $title ?? 'جستجو برای "' . $keyword . '"' }}</h1>
    <div class="row">
        @foreach($videos as $video)
            <x-video-box :video="$video"></x-video-box>
        @endforeach
    </div>

    <div class="text-center" dir="ltr">
        {{--{{ $videos->links('pagination::bootstrap-4') }}--}}
        {{ $videos->links() }}
    </div>

@endsection
