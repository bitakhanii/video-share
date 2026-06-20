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

    public function create(): View
    {
        $categories = Category::all();
        return view('videos.create.index', compact('categories'));
    }

    public function store(StoreVideoRequest $request): RedirectResponse
    {
        (new VideoService)->store($request->user(), $request->all());

        return success_redirect('index', 'create', 'ویدئو');
    }

    public function show(Video $video): View
    {
        // Gate::authorize('view', $video);

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
        (new VideoService)->update($video, $request->all());

        return success_redirect('back', 'update', 'ویدئو');
    }

    public function cutVideo(Request $request)
    {
        $path = Storage::putFile('', $request->file);
        $videoPath = Storage::path($path);
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => 'C:/ffmpeg/bin/ffmpeg.exe',
            'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe'
        ]);
        $video = $ffmpeg->open($videoPath);

        $ffprobe = $ffmpeg->getFFProbe();
        $video_probe = $ffprobe->format($videoPath);
        $duration = (int)$video_probe->get('duration');

        if ($duration > 40) {
            $video->filters()->clip(TimeCode::fromSeconds(0), TimeCode::fromSeconds(40))->synchronize();
            $video->save(new X264(), storage_path('app/public/test/' . '1.mp4'));
            unlink($videoPath);
        }
    }
}









