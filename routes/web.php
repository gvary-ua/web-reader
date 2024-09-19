<?php

use App\Http\Controllers\Web\V1\BooksController;
use App\Http\Controllers\Web\V1\ChaptersController;
use App\Http\Controllers\Web\V1\IndexController;
use App\Http\Controllers\Web\V1\ProfileController;
use Illuminate\Http\Request;
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

// Lang APIs
Route::get('language/{locale}', function (string $locale) {
    $supportedLocales = config('app.SUPPORTED_LOCALES');

    if (in_array($locale, $supportedLocales)) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }

    return redirect()->back();
})->name('language.show');

Route::put('language', function (Request $request) {
    $locale = $request['locale'];
    $supportedLocales = config('app.SUPPORTED_LOCALES');

    if (in_array($locale, $supportedLocales)) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
        $request->user()->update(['locale' => $locale]);
    }

    return redirect()->back();
})->name('language.update');

// Profile APIs

Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('profile/{user}/settings/profile', [ProfileController::class, 'editProfile'])->name('settings.profile');
    Route::get('profile/{user}/settings/account', [ProfileController::class, 'editAccount'])->name('settings.account');
    Route::get('profile/{user}/settings/security', [ProfileController::class, 'editSecurity'])->name('settings.security');
    Route::put('profile/{user}/settings/profile', [ProfileController::class, 'updateProfile'])->name('settings.profile.update');

    // Book APIs
    Route::get('books', [BooksController::class, 'index'])->name('books.index');
    Route::post('books', [BooksController::class, 'store'])->name('books.store');

    Route::get('books/{book}/edit', [BooksController::class, 'edit'])->name('books.edit');
    Route::put('books/{book}', [BooksController::class, 'update'])->name('books.update');
    Route::delete('books/{book}', [BooksController::class, 'destroy'])->name('books.destroy');
});
// Public Book APIs
Route::get('books/{book}', [BooksController::class, 'show'])->name('books.show');

// Public Chapter APIs
Route::get('books/{book}/chapters/{chapter}', [ChaptersController::class, 'show'])->name('chapters.show');

require __DIR__.'/auth.php';
