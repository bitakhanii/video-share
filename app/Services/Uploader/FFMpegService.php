<?php

namespace App\Services\Uploader;

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;

class FFMpegService
{
    private $ffprobe;
    public function __construct()
    {
        $this->ffprobe = FFProbe::create([
            'ffprobe.binaries'  => env('FFPROBE_PATH'),
        ]);
    }

    public function durationOf($path)
    {
        return (int) $this->ffprobe->format($path)->get('duration');
    }
}
