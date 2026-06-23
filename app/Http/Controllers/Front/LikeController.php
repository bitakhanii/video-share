<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function store(string $likeable_type, $likeable_id)
    {
        //Refer to AppServiceProvider.php
        $result = $likeable_id->likedBy(auth()->user());

        $attribute = $likeable_type == 'video' ? 'ویدئوی' : 'دیدگاه';
        return json_success_redirect('like.' . $result, $attribute, ['status' => $result]);
    }
}
