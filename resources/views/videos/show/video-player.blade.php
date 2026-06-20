<h1 class="video-title">{{ $video->name }}</h1>
<div class="video-code">
    <video controls style="height: 100%; width: 100%;">
        <source
            src="{{ $video->video_url }}"
            type="video/mp4">
    </video>
</div><!-- // video-code -->

<p>{{ $video->description }}</p>
@if($video->category_name)
    <span class="date"><i class="fa fa-tag"></i>{{ $video->category_name }}</span>
@endif
