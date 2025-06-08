<?php

namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Models\Topic\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::all();
        return view('topics.index', compact('topics'));
    }

    public function create()
    {
        return view('topics.create');
    }

    public function store(Request $request)
    {
        $topic = auth()->user()->topics()->create($request->all());
        return redirect()->route('topics.show', $topic);
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }
}
