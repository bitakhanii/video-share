<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryVideoController extends Controller
{
    public function index(Request $request, Category $category): View
    {
        $title = $category->name;
        $videos = $category->videos()
            ->with(['user', 'category'])
            ->filter($request->all())
            ->paginate()
            ->withQueryString();

        return view('videos.index.index', compact('title', 'videos'));
    }
}
