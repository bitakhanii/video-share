<?php

namespace App\Http\Controllers;

use App\Exceptions\FileHasAlreadyExistsException;
use App\Models\File;
use App\Services\Uploader\StorageManager;
use App\Services\Uploader\Uploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    private Uploader $uploader;

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

    public function upload(Request $request): RedirectResponse
    {
        try {
            $this->validate($request);
            $this->uploader->upload();
            return success_redirect('files.index', 'upload', 'file');
        } catch (FileHasAlreadyExistsException $e) {
            return error_redirect('back', 'upload-exists', 'file');
        }
    }

    public function download(File $file): StreamedResponse
    {
        if ($file->is_private) {
            Gate::authorize('role:admin');
        }
        return $file->download();
    }

    public function delete(File $file): RedirectResponse
    {
        $file->delete();
        return back();
    }

    private function validate($request): void
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,mp4,mov,mkv,zip,rar'],
        ]);
    }
}
