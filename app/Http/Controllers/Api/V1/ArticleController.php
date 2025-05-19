<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth:api', except: ['index']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::query()->paginate(5);
        return response()->json(new ArticleCollection($articles), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $this->uploadFile($request),
            'user_id' => 28,
        ]);

        return response()->json([
            'message' => 'created',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);

        return response()->json([
            'data' => new ArticleResource($article),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $this->uploadFile($request),
            'user_id' => 14,
        ]);

        return response()->json([
            'message' => 'updated',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Article::destroy($id);

        return response()->json([
            'message' => 'deleted'
        ], 200);
    }

    private function validate($request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);
    }

    private function uploadFile($request)
    {
        return $request->hasFile('image')
            ? $request->image->store('articles')
            : null;
    }
}
