<?php

namespace App\Http\Controllers;

use App\Exceptions\AparatVideoNotFoundException;
use App\Exceptions\CannotGetAparatFormActionException;
use App\Services\Aparat\AparatHandler;
use Illuminate\Http\Request;

class AparatController extends Controller
{
    private $aparatHandler;

    public function __construct(AparatHandler $aparatHandler)
    {
        $this->aparatHandler = $aparatHandler;
    }

    public function index()
    {
        $videos = $this->aparatHandler->mostViewedVideos();
        return view('aparat.videos', compact('videos'));
    }

    public function login()
    {
        $response = $this->aparatHandler->login();

        return response()->json([
            'data' => $response,
        ]);
    }

    public function upload(Request $request)
    {
        try {
            $response = $this->aparatHandler->upload($request->filename, $request->title,
                $request->category);
            return response()->json([
                'data' => $response
            ]);
        } catch (CannotGetAparatFormActionException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function show(Request $request)
    {
        try {
            $response = $this->aparatHandler->show($request->uid);

            return response()->json([
                'data' => $response
            ]);
        } catch (AparatVideoNotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        $response = $this->aparatHandler->delete($request->uid);

        return response()->json([
            'data' => $response
        ]);
    }
}
