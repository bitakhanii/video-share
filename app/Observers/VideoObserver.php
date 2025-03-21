<?php

namespace App\Observers;

use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoObserver
{
    /**
     * Handle the Video "created" event.
     */
    public function created(Video $video): void
    {
        //
    }

    /**
     * Handle the Video "updated" event.
     */
    public function updated(Video $video): void
    {
        if ($video->wasChanged('file')) {
            Storage::delete($video->getOriginal('file'));
        }
    }

    /**
     * Handle the Video "deleted" event.
     */
    public function deleted(Video $video)
    {
        if ($video->trashed()) return true;
        Storage::delete($video->file);
        Storage::delete('thumbnails/' . $video->thumbnail);
    }

    /**
     * Handle the Video "restored" event.
     */
    public function restored(Video $video): void
    {
        //
    }

    /**
     * Handle the Video "force deleted" event.
     */
    public function forceDeleted(Video $video): void
    {
        Storage::delete($video->file);
        Storage::delete('thumbnails/' . $video->thumbnail);
    }
}
