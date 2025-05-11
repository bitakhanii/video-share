<?php

namespace App\Services\Uploader;

use App\Exceptions\FileHasAlreadyExists;
use App\Exceptions\FileHasAlreadyExistsException;
use App\Models\File;
use Illuminate\Http\Request;

class Uploader
{
    private $request;
    private $storageManager;
    private $file;
    private $ffmpegService;
    public function __construct(Request $request, StorageManager $storageManager, FFMpegService $ffmpegService)
    {
        $this->request = $request;
        $this->storageManager = $storageManager;
        $this->file = $request->file;
        $this->ffmpegService = $ffmpegService;
    }

    public function upload()
    {
        if ($this->hasFileExists()) throw new FileHasAlreadyExistsException('File Has Already Exists.');
        $this->putFileIntoStorage();
        $this->saveFileIntoDatabase();
    }

    private function putFileIntoStorage()
    {
        $method = $this->isPrivate() ? 'putFileAsPrivate' : 'putFileAsPublic';

        return $this->storageManager->$method($this->file->getClientOriginalName(), $this->getType
        (), $this->file);
    }

    private function getType()
    {
        return [
            'image/jpeg' => 'image',
            'image/jpg' => 'image',
            'image/png' => 'image',
            'video/mp4' => 'video',
            'application/rar' => 'archive',
            'application/zip' => 'archive',
            'application/x-zip-compressed' => 'archive',
        ][$this->file->getClientMimeType()];
    }

    private function isPrivate()
    {
        return $this->request->has('is-private');
    }

    private function saveFileIntoDatabase()
    {
        $file = File::create([
            'name' => $this->file->getClientOriginalName(),
            'size' => $this->file->getSize(),
            'type' => $this->getType(),
            'is_private' => $this->isPrivate(),
        ]);

        $file->time = $this->getTime($file);
        $file->save();
    }

    private function getTime(File $file)
    {
        if (!$file->isMedia()) return null;

        return $this->ffmpegService->durationOf($file->absolutePath());
    }

    private function hasFileExists()
    {
        return $this->storageManager->hasFileExists($this->file->getClientOriginalName(), $this->getType(),
            $this->isPrivate());
    }
}
