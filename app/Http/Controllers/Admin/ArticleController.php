<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Article::class);

        $articles = Article::orderByDesc('updated_at')
            ->paginate(10)
        ;

        return view(
            'admin.articles.index',
            [
                'articles' => $articles,
            ]
        );
    }

    public function create()
    {
        Gate::authorize('create', Article::class);

        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleCreateRequest $request)
    {
        Gate::authorize('create', Article::class);

        // On crée un nouvel article
        $article = Article::make();

        // On ajoute les propriétés de l'article
        $article->title = $request->validated()['title'];
        $article->body = $request->validated()['body'];
        $article->published_at = $request->validated()['published_at'];
        $article->user_id = Auth::id();

        // Si il y a une image, on la sauvegarde
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('articles', 'public');
            $article->img_path = $path;
        }

        // On sauvegarde l'article en base de données
        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        Gate::authorize('update', $article);

        return view('admin.articles.edit', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        Gate::authorize('update', $article);

        // On modifies les propriétés de l'article
        $article->title = $request->validated()['title'];
        $article->body = $request->validated()['body'];
        $article->published_at = $request->validated()['published_at'];

        // Si il y a une image, on la sauvegarde
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('articles', 'public');
            $article->img_path = $path;
        }

        // On sauvegarde les modifications en base de données
        $article->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        $article->delete();

        return redirect()->back();
    }
}
