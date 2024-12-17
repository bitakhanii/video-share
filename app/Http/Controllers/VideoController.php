<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyEmail;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class VideoController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('verified', except: ['show']),
        ];
    }

    public function create()
    {
        $categories = Category::all();
        return view('videos.create', compact('categories'));
    }

    public function store(StoreVideoRequest $request)
    {
        $request->user()->videos()->create($request->all());
        return redirect()->route('index')->with(['alert' => __('alerts.success.create', ['attribute' => 'ویدئو']), 'alert-type' => 'success']);
    }

    public function show(Request $request, Video $video)
    {
        $video->load(['comments.user']);
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $video->update($request->all());
        return redirect()->route('videos.show', $video->slug)->with(['alert' => __('alerts.success.update', ['attribute' => 'ویدئو']), 'alert-type' => 'success']);
    }
}









