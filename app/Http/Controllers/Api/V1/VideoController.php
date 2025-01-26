<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\User;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    public function index(Request $request)
    {
        $videos = Video::filter($request->all())->paginate();
        return VideoResource::collection($videos);
    }

    public function store(StoreVideoRequest $request)
    {
        (new VideoService)->store(auth()->user(), $request->all());
        return response()->json('ویدئو با موفقیت ایجاد شد!', 201);
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        Gate::authorize('update', $video);
        (new VideoService)->update($video, $request->all());
        return response()->json('ویدئو با موفقیت ویرایش شد.', 200);
    }

    public function destroy(Video $video)
    {
        Gate::authorize('delete', $video);

        $video->delete();
        return response()->json('ویدئو با موفقیت حذف گردید.');
    }
}
