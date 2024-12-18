<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function index()
    {
        $mostViewedVideos = Video::with(['user', 'category'])->inRandomOrder()->limit(6)->get();
        $mostPopularVideos = Video::with(['user', 'category'])->inRandomOrder()->limit(6)->get();
        return view('index', compact('mostPopularVideos', 'mostViewedVideos'));
    }

    public function test()
    {
        $user = Video::with(['user', 'category'])->inRandomOrder()->limit(6)->get();
        dd($user);
    }
}
