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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
            new Middleware('can:update,video', only: ['edit', 'update']),
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

        return success_redirect('index', 'create', 'video');
    }

    public function show(Video $video): View
    {
        $video->increment('views');

        $userId = auth()->id();

        $video->load([
            'user',
            'comments' => fn($q) => $q->withAllRelations($userId),
            'likes' => fn($query) => $query->where('user_id', $userId),
            'category',
        ]);

        $video->loadCount([
            'likes as likes_count' =>fn($q) => $q->where('vote', 1),
            'likes as dislikes_count' =>fn($q) => $q->where('vote', -1),
        ]);

        return view('videos.show.index', compact('video'));
    }

    public function edit(Video $video): View
    {
        $categories = Category::all();
        return view('videos.edit.index', compact('video', 'categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video): RedirectResponse
    {
        $this->videoService->update($video, $request->all());
        return success_redirect('back', 'update', 'video');
    }

    public function destroy(Video $video): RedirectResponse
    {
        Gate::authorize('delete', $video);

        $video->forceDelete();
        return success_redirect('index', 'delete', 'video');
    }
}









