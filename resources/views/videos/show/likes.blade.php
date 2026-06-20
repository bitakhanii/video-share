<ul class="like">
    <li><a class="deslike"
           href="{{ route('dislikes.store', ['likeable_type' => 'video', 'likeable_id' => $video]) }}">{{ $video->dislikes_count }}
            <i class="fa fa-thumbs-down"></i></a></li>
    <li><a class="like"
           href="{{ route('likes.store', ['likeable_type' => 'video', 'likeable_id' => $video]) }}">{{ $video->likes_count }}
            <i class="fa fa-thumbs-up"></i></a></li>
</ul>
