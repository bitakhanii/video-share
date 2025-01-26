<?php

namespace App\Services;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class VideoService
{
    public function store(User $user, array $data)
    {
        $data = $this->putFile($data);

        return $user->videos()->create($data);
    }

    public function update(Video $video, array $data)
    {
        if (isset($data['file']) && $data['file'] instanceof File) {
            $data = $this->putFile($data);
        }

        return $video->update($data);
    }

    private function putFile(array $data)
    {
        $data['file'] = Storage::putFile('', $data['file']);

        $ffmpeg = new FFmpegAdapter($data['file']);
        $data['length'] = $ffmpeg->getDuration();
        $data['thumbnail'] = $ffmpeg->getThumbnail();

        return $data;
    }
}
