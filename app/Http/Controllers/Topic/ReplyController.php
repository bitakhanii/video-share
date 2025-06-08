<?php

namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Models\Topic\Topic;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Topic $topic)
    {

        $topic->replies()->create([
            'user_id' => auth()->user()->id,
            'text' => $request->text,
        ]);
        return back();
    }
}
