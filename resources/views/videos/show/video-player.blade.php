<h1 class="video-title h3 fw-bold mb-3">{{ $video->name }}</h1>

<div class="video-code ratio ratio-16x9 rounded-3 overflow-hidden bg-dark mb-3">
    <video controls class="w-100 h-100">
        <source
            src="{{ $video->video_url }}"
            type="video/mp4">
    </video>
</div><!-- // video-code -->

<p class="text-muted mb-2">{{ $video->description }}</p>

@if($video->category_name)
    <span class="date badge bg-light text-dark border">
        <i class="fa fa-tag me-1 text-danger"></i>{{ $video->category_name }}
    </span>
@endif
