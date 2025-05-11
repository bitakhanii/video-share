<?php

namespace App\Services\Uploader;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageManager
{
    public function putFileAsPublic(string $name, string $type, UploadedFile $file)
    {
        return Storage::disk('public')->putFileAs($type, $file, $name);
    }

    public function putFileAsPrivate(string $name, string $type, UploadedFile $file)
    {
        return Storage::disk('private')->putFileAs($type, $file, $name);
    }

    public function getAbsolutePath(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->path($this->directoryPrefix($name, $type));
    }

    public function hasFileExists(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->exists($this->directoryPrefix($name, $type));
    }

    public function getFile(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->download($this->directoryPrefix($name, $type));
    }

    public function removeFile(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->delete($this->directoryPrefix($name, $type));
    }

    private function disk($isPrivate)
    {
        return $isPrivate ? Storage::disk('private') : Storage::disk('public');
    }

    private function directoryPrefix($name, $type)
    {
        return $type . DIRECTORY_SEPARATOR . $name;
    }
}
