<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Video $video)
    {
        Gate::authorize('create', [Comment::class, $video]);

        $video->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return success_redirect('videos.show', 'create', 'نظر شما', model: $video);
    }
}
