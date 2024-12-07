<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryVideoController extends Controller
{
    public function index(Category $category)
    {
        $title = $category->name;
        $videos = $category->videos()->paginate();
        return view('videos.index', compact('title', 'videos'));
    }
}
