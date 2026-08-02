@extends('layout')
@section('content')

    <div class="container py-4">

        @include('videos.index.sort')

        <h1 class="new-video-title h3 fw-bold d-flex align-items-center gap-2 mt-4 mb-3">
            <i class="fa fa-bolt text-danger"></i>
            {{ $title ?? 'جستجو برای "' . $keyword . '"' }}
        </h1>

        <div class="row g-3">
            @foreach($videos as $video)
                <x-video-box :video="$video"></x-video-box>
            @endforeach
        </div>

        <div class="text-center mt-4" dir="ltr">
            {{--{{ $videos->links('pagination::bootstrap-4') }}--}}
            {{ $videos->links() }}
        </div>

    </div>

@endsection
