<?php

namespace App\Http\Controllers;

use App\Models\Article;

class HomepageController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->where('published_at', '<', now())
            ->withCount('comments')
            ->take(4)
            ->orderByDesc('published_at')
            ->get()
        ;

        return view('homepage.index', [
            'articles' => $articles,
        ]);
    }
}
