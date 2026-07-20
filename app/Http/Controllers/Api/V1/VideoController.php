<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\User;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class VideoController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', only: ['store', 'update', 'destroy']),
        ];
    }

    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    public function index(Request $request)
    {
        $videos = Video::filter($request->all())->paginate(10);
        return VideoResource::collection($videos);
    }

    public function store(StoreVideoRequest $request)
    {
        (new VideoService)->store(auth()->user(), $request->all());
        return json_success_redirect('create', 'video', 201);
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        Gate::authorize('update', $video);

        (new VideoService)->update($video, $request->all());
        return json_success_redirect('update', 'video');
    }

    public function destroy(Video $video)
    {
        Gate::authorize('delete', $video);

        $video->forceDelete();
        return json_success_redirect('delete', 'video');
    }
}
