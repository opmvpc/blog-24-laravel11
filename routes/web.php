<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'index']);

Route::get('/articles', [ArticleController::class, 'index'])->name('front.articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('front.articles.show');

Route::middleware('auth')->group(function () {
    // Ajout d'un commentaire
    Route::post('/articles/{article}/comments', [ArticleController::class, 'addComment'])->name('front.articles.comments.add');
    // Suppression d'un commentaire
    Route::delete('/articles/{article}/comments/{comment}', [ArticleController::class, 'deleteComment'])->name('front.articles.comments.delete');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::resource('articles', AdminArticleController::class);

    // Gestion des utilisateurs (Détails et changement de rôle)
    Route::resource('/users', UserController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

// Détail d'un profil utilisateur
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

require __DIR__.'/auth.php';
