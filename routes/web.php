<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;

Route::get(
    '/',
    [PageController::class, 'home']
)->name('home');

Route::get(
    'blog',
    [PageController::class, 'listablogs']
)->name('blog');

Route::get(
    'blog/{post:slug}',
    [PageController::class, 'post']
)->name('post');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class)->middleware('auth')->except('show');

require __DIR__ . '/auth.php';
