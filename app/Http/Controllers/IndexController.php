<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function index()
    {
        $mostViewedVideos = Video::all()->random(6);
        $mostPopularVideos = Video::all()->random(6);
        return view('index', compact('mostPopularVideos', 'mostViewedVideos'));
    }

    public function test()
    {
        return fake()->realText(500);
    }
}
