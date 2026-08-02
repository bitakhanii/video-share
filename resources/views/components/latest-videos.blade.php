<section class="video-section mb-5">
    <h2 class="section-title"><i class="fa fa-bolt"></i> آخرین ویدیو‌ها</h2>
    <div class="row g-3">
        @foreach($videos as $video)
            <x-video-box :video="$video"></x-video-box>
        @endforeach
    </div>
</section>
