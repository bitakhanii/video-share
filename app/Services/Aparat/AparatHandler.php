<?php

namespace App\Services\Aparat;

use App\Exceptions\AparatVideoNotFoundException;
use App\Exceptions\CannotGetAparatFormActionException;
use App\Exceptions\CannotGetAparatLoginTokenException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AparatHandler
{
    private Http $http;
    private $user;
    const TOKEN_EXPIRE_TIME = 3600;

    public function __construct(Http $http)
    {
        $this->http = $http;
        $this->user = config('aparat.user');
    }

    public function mostViewedVideos()
    {
        $url = config('aparat.mostViewedVideosUrl');

        $response = $this->http::get($url);
        return $response->json('mostviewedvideos');
    }

    public function login()
    {
        $password = config('aparat.password');
        $url = config('aparat.loginUrl');
        $url = $this->replaceParams($url, [
            'user' => $this->user,
            'password' => $password
        ]);

        $response = $this->http::get($url);
        return $response->json('login');
    }

    public function upload(string $filename, string $title, int $category)
    {
        $response = $this->getUploadForm();

        $formAction = $response['formAction'];
        $formID = $response['frm-id'];

        $uploadResponse = Http::attach('video', file_get_contents(Storage::disk('public')->path('video/'. $filename)), $filename)->post($formAction, [
            [
                'name' => 'frm-id',
                'contents' => $formID,
            ],
            [
                'name' => 'data[title]',
                'contents' => $title,
            ],
            [
                'name' => 'data[category]',
                'contents' => $category,
            ]
        ]);

        return $uploadResponse->json();
    }

    public function show(string $uid)
    {
        $url = config('aparat.videoInfoUrl');
        $url = $this->replaceParams($url, [
            'uid' => $uid
        ]);

        $response = $this->http::get($url);
        if (is_null($response->json('video'))) {
            throw new AparatVideoNotFoundException;
        }

        return $response->json('video');
    }

    public function delete(string $uid)
    {
        $url = config('aparat.deleteVideoLink');
        $url = $this->replaceParams($url, [
           'uid' => $uid,
           'user' => $this->user,
           'token' => $this->getToken(),
        ]);

        $response = $this->http::get($url);
        $deleteUrl = $response->json('deletevideolink.deleteurl');
        $deleteResponse = $this->http::get($deleteUrl);

        return $deleteResponse->json('deletevideo');
    }

    private function getToken()
    {
        return Cache::remember('aparat_token_new', self::TOKEN_EXPIRE_TIME, function () {

            $loginData = $this->login();

            if (array_key_exists('ltoken', $loginData)) {
                return $loginData['ltoken'];
            }

            throw new CannotGetAparatLoginTokenException();
        });
    }

    private function getUploadForm()
    {
        $url = config('aparat.uploadFormUrl');
        $url = $this->replaceParams($url, [
            'user' => $this->user,
            'token' => $this->getToken()
        ]);

        $response = $this->http::get($url);

        if (is_null($response->json('uploadform.formAction'))) {
            throw new CannotGetAparatFormActionException();
        }

        return $response->json('uploadform');
    }

    private function replaceParams($url, $options)
    {
        foreach ($options as $key => $value) {
            $url = str_replace('{' . $key . '}', $value, $url);
        }

        return $url;
    }

}
