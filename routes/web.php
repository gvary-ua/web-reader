<?php

use App\Http\Controllers\Web\V1\BooksController;
use App\Http\Controllers\Web\V1\ChaptersController;
use App\Http\Controllers\Web\V1\IndexController;
use App\Http\Controllers\Web\V1\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

// Profile APIs

Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('profile/{user}/settings/profile', [ProfileController::class, 'editProfile'])->name('settings.profile');
    Route::get('profile/{user}/settings/account', [ProfileController::class, 'editAccount'])->name('settings.account');
    Route::get('profile/{user}/settings/security', [ProfileController::class, 'editSecurity'])->name('settings.security');
    Route::put('profile/{user}/settings/profile', [ProfileController::class, 'updateProfile'])->name('settings.profile.update');
});

// Book APIs

Route::get('books', [BooksController::class, 'index'])->name('books.index');
Route::post('books', [BooksController::class, 'store'])->name('books.store');
Route::get('books/{book}', [BooksController::class, 'show'])->name('books.show');

// Route::get('books/{book}/edit', [BooksController::class, 'edit'])->name('books.edit');
// Route::put('books/{book}', [BooksController::class, 'update'])->name('books.update');
// Route::patch('books/{book}', [BooksController::class, 'update'])->name('books.update');
Route::delete('books/{book}', [BooksController::class, 'destroy'])->name('books.destroy');

// Chapter APIs

Route::get('books/{book}/chapters/{chapter}', [ChaptersController::class, 'show'])->name('chapters.show');

require __DIR__.'/auth.php';
