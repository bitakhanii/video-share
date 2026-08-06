<?php

namespace App\Services\Uploader;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StorageManager
{
    public function putFileAsPublic(string $name, string $path, UploadedFile $file): false|string
    {
        return Storage::disk('public')->putFileAs($path, $file, $name);
    }

    public function putFileAsPrivate(string $name, string $path, UploadedFile $file): false|string
    {
        return Storage::disk('private')->putFileAs($path, $file, $name);
    }

    public function getAbsolutePath(string $name, string $path, bool $isPrivate): string
    {;
        return $this->disk($isPrivate)->path($this->directoryPrefix($name, $path));
    }

    public function hasFileExists(string $name, string $path, bool $isPrivate): bool
    {
        return $this->disk($isPrivate)->exists($this->directoryPrefix($name, $path));
    }

    public function getFile(string $name, string $path, bool $isPrivate): StreamedResponse
    {
        return $this->disk($isPrivate)->download($this->directoryPrefix($name, $path));
    }

    public function removeFile(string $name, string $path, bool $isPrivate): bool
    {
        return $this->disk($isPrivate)->delete($this->directoryPrefix($name, $path));
    }

    private function disk(bool $isPrivate): Filesystem
    {
        return $isPrivate ? Storage::disk('private') : Storage::disk('public');
    }

    private function directoryPrefix($name, $type): string
    {
        return $type . DIRECTORY_SEPARATOR . $name;
    }
}
