<?php

namespace App\Services;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\File;

class VideoService
{
    public function latest(): Collection
    {
        return Video::with(['user', 'category'])
            ->latest()
            ->take(6)
            ->get();
    }
    public function mostViewed(): Collection
    {
        return Video::with(['user', 'category'])
            ->orderBy('views', 'desc')
            ->limit(6)
            ->get();
    }

    public function mostPopular(): Collection
    {
        return Video::with(['user', 'category'])
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit(6)
            ->get();
    }
    public function store(User $user, array $data)
    {
        $data = $this->putFile($data);

        return $user->videos()->create($data);
    }

    public function update(Video $video, array $data): bool
    {
        if (isset($data['file']) && $data['file'] instanceof File) {
            $data = $this->putFile($data);
        }

        return $video->update($data);
    }

    private function putFile(array $data): array
    {
        $path = Storage::putFile('videos', $data['file']);

        $data['file'] = Str::after($path, 'videos/');

        $ffmpeg = new FFmpegAdapter($path);
        $data['length'] = $ffmpeg->getDuration();
        $data['thumbnail'] = $ffmpeg->getThumbnail();

        return $data;
    }
}
