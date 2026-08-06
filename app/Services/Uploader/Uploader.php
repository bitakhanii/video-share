<?php

namespace App\Services\Uploader;

use App\Exceptions\FileHasAlreadyExistsException;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Uploader
{
    private Request $request;
    private StorageManager $storageManager;
    private $file;
    private FFMpegService $ffmpegService;

    public function __construct(Request $request, StorageManager $storageManager, FFMpegService $ffmpegService)
    {
        $this->request = $request;
        $this->storageManager = $storageManager;
        $this->file = $request->file;
        $this->ffmpegService = $ffmpegService;
    }

    /**
     * @throws FileHasAlreadyExistsException
     * @throws \Throwable
     */
    public function upload(): void
    {
        if ($this->hasFileExists()) throw new FileHasAlreadyExistsException('File Has Already Exists.');

        DB::transaction(function () {
            $this->putFileIntoStorage();
            $this->saveFileIntoDatabase();
        });
    }

    private function putFileIntoStorage(): void
    {
        $method = $this->isPrivate() ? 'putFileAsPrivate' : 'putFileAsPublic';

        $this->storageManager->$method($this->file->getClientOriginalName(), $this->getPath(), $this->file);
    }

    private function getType(): string
    {
        $mimeType = $this->file->getClientMimeType();

        $type = explode('/', $mimeType)[0];
        if ($type === 'application') {
            return 'archive';
        }

        return $type;
    }

    private function isPrivate(): bool
    {
        return $this->request->has('is-private');
    }

    private function saveFileIntoDatabase(): void
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

    private function getTime(File $file): ?int
    {
        if (!$file->isMedia()) return null;

        return $this->ffmpegService->durationOf($file->absolutePath());
    }

    private function hasFileExists(): bool
    {
        return $this->storageManager->hasFileExists($this->file->getClientOriginalName(), $this->getPath(),
            $this->isPrivate());
    }

    private function getPath(): string
    {
        return Str::plural($this->getType());
    }
}
