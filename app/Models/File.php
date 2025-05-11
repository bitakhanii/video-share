<?php

namespace App\Models;

use App\Services\Uploader\StorageManager;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name', 'size', 'time', 'type', 'is_private',
    ];

    public function isMedia()
    {
        return $this->type == 'video';
    }

    public function absolutePath()
    {
        return (new StorageManager())->getAbsolutePath($this->name, $this->type, $this->is_private);
    }

    public function download()
    {
        return resolve(StorageManager::class)->getFile($this->name, $this->type, $this->is_private);
    }

    public function delete()
    {
        (new  StorageManager())->removeFile($this->name, $this->type, $this->is_private);

        parent::delete();
    }
}
