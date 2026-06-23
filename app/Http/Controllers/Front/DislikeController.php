<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class DislikeController extends Controller
{
    public function store(string $likeable_type, $likeable_id)
    {
        //Refer to AppServiceProvider.php
        $result = $likeable_id->dislikedBy(auth()->user());

        $attribute = $likeable_type == 'video' ? 'ویدئوی' : 'دیدگاه';
        return json_success_redirect('dislike.' . $result, $attribute, ['status' => $result]);
    }
}
