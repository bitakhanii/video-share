<?php

namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Models\Topic\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function create()
    {
        return view('badges.create');
    }

    public function store(Request $request)
    {
        Badge::create($request->all());
        return back();
    }
}
