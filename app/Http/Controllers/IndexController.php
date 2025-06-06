<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Role;
use App\Models\User;
use App\Models\Video;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
        $admin = new Admin();
        $admin->test();
    }
}
