<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class DislikeController extends Controller
{
    public function __invoke(string $likeable_type, $likeable_id)
    {
        if (!auth()->check()) {
            return json_error_redirect('auth', 'auth.dislike');
        }
        //Refer to AppServiceProvider.php
        $result = $likeable_id->dislikedBy(auth()->user());

        $attribute = $likeable_type == 'video' ? 'video' : 'comment';
        return json_success_redirect('dislike.' . $result, $attribute,
            201, ['status' => $result]);
    }
}
