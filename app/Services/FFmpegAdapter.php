<?php

namespace App\Services;

use AllowDynamicProperties;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use Illuminate\Support\Facades\Storage;

#[AllowDynamicProperties]
class FFmpegAdapter
{
    public function __construct(public string $path)
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => env('FFMPEG_PATH'),
            'ffprobe.binaries' => env('FFPROBE_PATH'),
        ]);

        $ffprobe = $ffmpeg->getFFProbe();
        $this->video_probe = $ffprobe->format(Storage::path($this->path));

        $this->video = $ffmpeg->open(Storage::path($this->path));
    }

    public function getDuration(): int
    {
        return (int)$this->video_probe->get('duration');
    }

    public function getThumbnail(): string
    {
        $fileName = pathinfo($this->path, PATHINFO_FILENAME) . '.jpg';
        $storage_path = storage_path('app/public/thumbnails/' . $fileName);

        $this->video->frame(TimeCode::fromSeconds(1))->save($storage_path);
        return $fileName;
    }
}
