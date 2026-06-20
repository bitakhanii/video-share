<div id="comments" class="post-comments">
    <h3 class="post-box-title"><span>{{ $video->comments->count() }}</span> نظر</h3>
    <ul class="comments-list">
        @foreach($video->comments as $comment)
            <li>
                <div class="post_author">
                    <div class="img_in">
                        <a href="#"><img src="{{ $comment->user->gravatar }}"
                                         alt=""></a>
                    </div>
                    <a href="#" class="author-name">{{ $comment->user->name }}</a>
                    <time
                        datetime="2017-03-24T18:18">{{ $comment->created_at }}</time>
                    <a class='deslike mr-5' style="color: #aaaaaa"
                       href="{{ route('dislikes.store', ['likeable_type' => 'comment', 'likeable_id' => $comment]) }}">{{ $comment->dislikes_count }}
                        <i class="fa fa-thumbs-down"></i></a>
                    <a class='like mr-5' style="color: #66c0c2"
                       href="{{ route('likes.store', ['likeable_type' => 'comment', 'likeable_id' => $comment]) }}">{{ $comment->likes_count }}
                        <i
                            class="fa fa-thumbs-up"></i></a>
                </div>
                <p>{{ $comment->body }}</p>
                <a href="#" class="reply">پاسخ</a>
            </li>
        @endforeach
    </ul>

    @auth
        <h3 class="post-box-title">ارسال نظرات</h3>
        <x-validation-errors></x-validation-errors>
        <form action="{{ route('comments.store', $video) }}"
              method="POST"
              id="comment-form">
            @csrf
            <textarea class="form-control" name="body" rows="8" id="Message"
                      placeholder="متن پیام">{{ old('body') }}</textarea>
            <button id="contact_submit" class="btn btn-dm">ارسال پیام</button>
        </form>
    @endauth

    @guest
        <div class="alert alert-warning">برای افزودن دیدگاه خود، ابتدا باید در سایت ثبت نام
            کنید.
        </div>
    @endguest

    @if ($errors->has('body'))
        <script>
            document.getElementById('comment-form').scrollIntoView({
                behavior: 'smooth'
            });
        </script>
    @endif
</div>
