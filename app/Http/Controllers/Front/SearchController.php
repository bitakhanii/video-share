<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Video;

class SearchController extends Controller
{
    public function index()
    {
        $videos = Video::with(['user', 'category'])
            ->filter(request()->all())
            ->paginate()
            ->withQueryString();

        return view('videos.index.index', compact('videos'))
            ->with([
                'keyword' => request('q'),
                'sortByQuery' => request('sortBy'),
                'lengthQuery' => request('length'),
            ]);
    }
}
