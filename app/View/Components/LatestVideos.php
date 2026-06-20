<?php

namespace App\View\Components;

use App\Models\Video;
use App\Services\VideoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LatestVideos extends Component
{
    public $videos;
    /**
     * Create a new component instance.
     */
    public function __construct(VideoService $videoService)
    {
        $this->videos = $videoService->latest();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.latest-videos');
    }
}
