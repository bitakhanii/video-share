<?php

namespace App\Http\Controllers;

use App\Exceptions\FileHasAlreadyExistsException;
use App\Models\File;
use App\Services\Uploader\StorageManager;
use App\Services\Uploader\Uploader;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private $uploader;
    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function index()
    {
        $files = File::all();
        return view('files.index', compact('files'));
    }

    public function create()
    {
        return view('files.create');
    }

    public function new(Request $request)
    {
        try {
            $this->validate($request);
            $this->uploader->upload();
            return back()->with([
                'alert' => __('alerts.success.upload'),
                'alert-type' => 'success',
            ]);
        } catch (FileHasAlreadyExistsException $e) {
            return back()->with([
                'alert' => __('alerts.danger.upload'),
                'alert-type' => 'danger',
            ]);
        }
    }

    public function download(File $file)
    {
        return $file->download();
    }

    public function delete(File $file)
    {
        $file->delete();
        return back();
    }

    private function validate($request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,mp4,zip, rar'],
        ]);
    }
}
