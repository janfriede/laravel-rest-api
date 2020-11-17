<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:articles',
            'description' => 'required|string|min:20',
            'content' => 'required|string',
            'active' => 'boolean',
        ]);

        $article = new Article([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'content' => $request->get('content'),
            'active' => $request->get('active'),
        ]);
        $article->save();

        return response()->json($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'required|string|unique:articles',
            'description' => 'required|string|min:20',
            'content' => 'required|string',
            'active' => 'boolean',
        ]);

        $article->update($request->all());

        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return Response
     * @throws Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json([
            'message' => 'Successfully deleted article!'
        ], 200);
    }
}
