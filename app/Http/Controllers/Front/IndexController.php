<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Services\VideoService;

class IndexController extends Controller
{
    protected VideoService $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function index()
    {
        return view('index', [
            'mostPopularVideos' => $this->videoService->mostPopular(),
            'mostViewedVideos' => $this->videoService->mostViewed(),
        ]);
    }
}
