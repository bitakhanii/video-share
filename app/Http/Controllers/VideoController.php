<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyEmail;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Video;
use App\Services\FFmpegAdapter;
use App\Services\VideoService;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

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
        (new VideoService)->store($request->user(), $request->all());
        return redirect()->route('index')->with(['alert' => __('alerts.success.create', ['attribute' => 'ویدئو']), 'alert-type' => 'success']);
    }

    public function show(Request $request, Video $video)
    {
       // Gate::authorize('view', $video);

        $video->load(['comments.user']);
        return view('videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        Gate::authorize('update', $video);

        $categories = Category::all();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        (new VideoService)->update($video, $request->all());

        return redirect()->route('videos.show', $video->slug)->with(['alert' => __('alerts.success.update', ['attribute' => 'ویدئو']), 'alert-type' => 'success']);
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
            $video->save(new X264(), storage_path('app/public/test/'. '1.mp4'));
            unlink($videoPath);
        }
    }

}









