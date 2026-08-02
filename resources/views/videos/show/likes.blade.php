<ul class="like video-like-container list-unstyled d-flex gap-2 m-0">
    <li>
        <a class="deslike dislike-resource btn btn-outline-secondary btn-sm rounded-pill"
           data-id="{{ $video->slug }}" data-resource="video"
           style="color: @if($video->isDislikedBy(auth()->user())) #e0001c @endif" href="#">
            <span class="me-1">{{ $video->dislikes_count }}</span>
            <i class="fa fa-thumbs-down"></i>
        </a>
    </li>

    <li>
        <a class="like like-resource btn btn-outline-secondary btn-sm rounded-pill"
           data-id="{{ $video->slug }}" data-resource="video"
           style="color: @if($video->isLikedBy(auth()->user())) #1b87ff @endif" href="#">
            <span class="me-1">{{ $video->likes_count }}</span>
            <i class="fa fa-thumbs-up"></i>
        </a>
    </li>
</ul>
