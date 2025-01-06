<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryVideoController extends Controller
{
    public function index(Request $request, Category $category)
    {
        $title = $category->name;
        $videos = $category->videos()->with(['user', 'category'])->filter($request->all())->paginate()->withQueryString();

        return view('videos.index', compact('title', 'videos'));
    }
}
