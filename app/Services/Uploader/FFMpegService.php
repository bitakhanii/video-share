<?php

namespace App\Services\Uploader;

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;

class FFMpegService
{
    private FFProbe $ffprobe;
    public function __construct()
    {
        $this->ffprobe = FFProbe::create([
            'ffprobe.binaries'  => config('services.ffmpeg.ffprobe_path'),
        ]);
    }

    public function durationOf(string $path): int
    {
        return $this->ffprobe->format($path)->get('duration');
    }
}
