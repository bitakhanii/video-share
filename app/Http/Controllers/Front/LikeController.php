<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function __invoke(string $likeable_type, $likeable_id)
    {
        if (!auth()->check()) {
            return json_error_redirect('auth', 'auth.like');
        }
        //Refer to AppServiceProvider.php
        $result = $likeable_id->likedBy(auth()->user());

        $attribute = $likeable_type == 'video' ? 'video' : 'comment';
        return json_success_redirect('like.' . $result, $attribute, 201, ['status' => $result]);
    }
}
