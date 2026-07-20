<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __invoke(StoreCommentRequest $request, Video $video)
    {
        $video->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return success_redirect('videos.show', 'create', 'comment', model: $video);
    }
}
