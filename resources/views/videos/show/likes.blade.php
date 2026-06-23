<ul class="like video-like-container">
    <li><a class="deslike dislike-resource" data-id="{{ $video->slug }}" data-resource="video"
           style="color: @if($video->isDislikedBy(auth()->user())) #e0001c @endif" href="#">
            <span style="margin-left: 5px;">{{ $video->dislikes_count }}</span>
            <i class="fa fa-thumbs-down"></i>
        </a></li>

    <li><a class="like like-resource" data-id="{{ $video->slug }}" data-resource="video"
           style="color: @if($video->isLikedBy(auth()->user())) #1b87ff @endif" href="#">
            <span style="margin-left: 5px;">{{ $video->likes_count }}</span>
            <i class="fa fa-thumbs-up"></i>
        </a></li>
</ul>
