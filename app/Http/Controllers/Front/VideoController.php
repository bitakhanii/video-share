<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Video;
use App\Services\VideoService;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('verified', except: ['show']),
        ];
    }

    // به صورت readonly تعریف شده تا پس از مقداردهی اولیه، غیرقابل تغییر باشد.(اختیاری)
    public function __construct(private readonly VideoService $videoService)
    {
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('videos.create.index', compact('categories'));
    }

    public function store(StoreVideoRequest $request): RedirectResponse
    {
        $this->videoService->store($request->user(), $request->all());

        return success_redirect('index', 'create', 'ویدئو');
    }

    public function show(Video $video): View
    {
        // Gate::authorize('view', $video);

        $video->increment('views');

        $video->load(['comments.user', 'likes', 'category']);
        return view('videos.show.index', compact('video'));
    }

    public function edit(Video $video): View
    {
        Gate::authorize('update', $video);

        $categories = Category::all();
        return view('videos.edit.index', compact('video', 'categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video): RedirectResponse
    {
        $this->videoService->update($video, $request->all());

        return success_redirect('back', 'update', 'ویدئو');
    }
}









