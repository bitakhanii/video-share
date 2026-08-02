<div id="comments" class="post-comments mt-4">
    <h3 class="post-box-title h5 fw-bold mb-3"><span>{{ $video->comments->count() }}</span> نظر</h3>

    <ul class="comments-list list-unstyled d-flex flex-column gap-3">
        @foreach($video->comments as $comment)
            <li class="border rounded-3 p-3">
                <div class="post_author d-flex align-items-center flex-wrap gap-2">
                    <div class="img_in">
                        <a href="#">
                            <img src="{{ $comment->user->gravatar }}" alt="" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                        </a>
                    </div>
                    <a href="#" class="author-name fw-semibold text-dark text-decoration-none">{{ $comment->user->name }}</a>
                    <time class="text-muted small" datetime="2017-03-24T18:18">{{ $comment->created_at }}</time>

                    <div class="comment-like-container d-flex gap-2 ms-auto">
                        <a class="deslike dislike-resource btn btn-outline-secondary btn-sm rounded-pill"
                           data-id="{{ $comment->id }}" data-resource="comment"
                           style="color: @if($comment->isDislikedBy(auth()->user())) #e0001c @endif" href="#">
                            <span class="me-1">{{ $comment->dislikes_count }}</span>
                            <i class="fa fa-thumbs-down"></i>
                        </a>

                        <a class="like like-resource btn btn-outline-secondary btn-sm rounded-pill"
                           data-id="{{ $comment->id }}" data-resource="comment"
                           style="color: @if($comment->isLikedBy(auth()->user())) #1b87ff @endif" href="#">
                            <span class="me-1">{{ $comment->likes_count }}</span>
                            <i class="fa fa-thumbs-up"></i>
                        </a>
                    </div>
                </div>

                <p class="mt-2 mb-1">{{ $comment->body }}</p>
                <a href="#" class="reply small">پاسخ</a>
            </li>
        @endforeach
    </ul>

    <h3 class="post-box-title h5 fw-bold mt-4 mb-3">ارسال نظرات</h3>

    @auth
        @can('create', [\App\Models\Comment::class, $video])
            <x-validation-errors></x-validation-errors>
            <form action="{{ route('comments.store', $video) }}"
                  method="POST"
                  id="comment-form">
                @csrf
                <textarea class="form-control mb-3" name="body" rows="6" id="Message"
                          placeholder="متن پیام">{{ old('body') }}</textarea>
                <button id="contact_submit" class="btn btn-danger px-4">ارسال پیام</button>
            </form>
        @else
            <div class="alert alert-warning">
                مالک ویدئو نمی‌تواند برای ویدئوی خود دیدگاهی وارد نماید !
            </div>
        @endcan
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
