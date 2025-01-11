<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;
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

        return back()->with(['alert' => __('alerts.success.create', ['attribute' => 'نظر شما']), 'alert-type' => 'success']);
    }
}
