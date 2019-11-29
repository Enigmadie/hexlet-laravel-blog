<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller {
    public function edit($id) {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|unique:articles,name,' . $article->id,
            'body' => 'required|min:100',
        ]);

        $article->fill($request->all());
        $article->save();
        return redirect()
        ->route('articles.index');
    }
    public function index()
    {
        $articles = Article::paginate();
        return view('article.index', compact('articles'));
    }
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }
    public function create()
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:10',
        ]);

        $article = new Article();
        $article->fill($request->all());
        $article->save();
        return redirect()
            ->route('articles.index');
    }
    public function destroy($id) {
        $article = Article::find($id);
        if ($article) {
          $article->delete();
        }
        return redirect()->route('articles.index');
    }
    //
}
