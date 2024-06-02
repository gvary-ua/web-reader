<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('profile/{user}/settings/profile', [ProfileController::class, 'editProfile'])->name('settings.profile');
    Route::get('profile/{user}/settings/account', [ProfileController::class, 'editAccount'])->name('settings.account');
    Route::get('profile/{user}/settings/security', [ProfileController::class, 'editSecurity'])->name('settings.security');
    Route::put('profile/{user}/settings/profile', [ProfileController::class, 'updateProfile'])->name('settings.profile.update');
});

require __DIR__.'/auth.php';
