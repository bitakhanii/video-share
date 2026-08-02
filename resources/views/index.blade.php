@extends('layout')
@section('content')

    <div class="container py-4">

        <x-latest-videos></x-latest-videos>

        <section class="video-section mb-5">
            <h2 class="section-title"><i class="fa fa-bolt"></i> پربازدیدترین ویدیوها</h2>
            <div class="row g-3">
                @foreach($mostViewedVideos as $video)
                    <x-video-box :video="$video"></x-video-box>
                @endforeach
            </div>
        </section>

        <section class="video-section mb-5">
            <h2 class="section-title"><i class="fa fa-bolt"></i> محبوب‌ترین‌ها</h2>
            <div class="row g-3">
                @foreach($mostPopularVideos as $video)
                    <x-video-box :video="$video"></x-video-box>
                @endforeach
            </div>
        </section>

    </div>

@endsection
