<?php

namespace App\Models;

use App\Services\Uploader\StorageManager;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class File extends Model
{
    protected $fillable = [
        'name', 'size', 'time', 'type', 'is_private',
    ];

    /* Accessor Methods */
    public function fileUrl(): Attribute
    {
        $isPrivate = $this->is_private ? 'private' : 'public';
        return Attribute::get(function () use ($isPrivate) {
            return '/storage/' . $isPrivate . '/' . $this->type . 's/' . $this->name;
        });
    }

    /* End Accessor Methods */

    public function isMedia(): bool
    {
        return $this->type == 'video';
    }

    public function absolutePath(): string
    {
        return (new StorageManager())->getAbsolutePath($this->name, $this->getPath(), $this->is_private);
    }

    public function download(): StreamedResponse
    {
        return resolve(StorageManager::class)->getFile($this->name, $this->getPath(), $this->is_private);
    }

    public function delete(): void
    {
        parent::delete();

        (new  StorageManager())->removeFile($this->name, $this->getPath(), $this->is_private);
    }

    private function getPath(): string
    {
        return Str::plural($this->type);
    }
}
