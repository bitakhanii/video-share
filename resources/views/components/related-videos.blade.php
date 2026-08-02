<div id="related-posts" class="d-flex flex-column gap-3">

    @foreach($videos as $video)
        <!-- video item -->
        <div class="related-video-item d-flex gap-2">
            <div class="thumb position-relative flex-shrink-0" style="width:140px;">
                <small class="time position-absolute bottom-0 end-0 m-1 badge bg-dark bg-opacity-75">{{ $video->length_in_human }}</small>
                <a href="{{ route('videos.show', $video->slug) }}">
                    <img src="{{ $video->video_thumbnail }}" alt="" class="rounded-3 w-100" style="height:80px; object-fit:cover;">
                </a>
            </div>
            <div class="d-flex flex-column justify-content-center overflow-hidden">
                <a href="{{ route('videos.show', $video->slug) }}" class="title fw-semibold text-dark text-decoration-none text-truncate">{{ $video->name }}</a>
                <a class="channel-name text-muted small text-decoration-none" href="#">
                    {{ $video->owner_name }}
                    <span><i class="fa fa-check-circle text-primary"></i></span>
                </a>
            </div>
        </div>
    @endforeach

</div>
