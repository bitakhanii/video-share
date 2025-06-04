<?php

return [

    'mostViewedVideosUrl' => 'https://www.aparat.com//etc/api/mostviewedvideos',
    'loginUrl' => 'https://www.aparat.com/etc/api/login/luser/{user}/lpass/{password}',
    'uploadFormUrl' => 'https://www.aparat.com/etc/api/uploadform/luser/{user}/ltoken/{token}',
    'videoInfoUrl' => 'https://www.aparat.com/etc/api/video/videohash/{uid}',
    'deleteVideoLink' => 'https://www.aparat.com/etc/api/deletevideolink/videohash/{uid}/luser/{user}/ltoken/{token}',
    'user' => env('APARAT_USER'),
    'password' => env('APARAT_PASSWORD'),

];
