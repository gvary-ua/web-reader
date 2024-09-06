<?php

use App\Http\Controllers\Api\V1\BlocksApi;
use App\Http\Controllers\Api\V1\ChapterController;
use App\Http\Controllers\Api\V1\CoverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::group(['prefix' => 'v1'], function () {
        /* Chapters APIs */
        Route::get('chapters', [ChapterController::class, 'index'])->name('api.chapters.index');
        Route::post('chapters', [ChapterController::class, 'store'])->name('api.chapters.store');
        Route::patch('chapters/{chapter}', [ChapterController::class])->name('api.chapters.update');

        /* Blocks APIs */
        Route::post('chapters/{chapterId}/blocks', [BlocksApi::class, 'bulkStore'])->name('api.blocks.bulkStore');
        Route::get('chapters/{chapterId}/blocks', [BlocksApi::class, 'index'])->name('api.blocks.index');

        /* Cover APIs */
        Route::get('covers/{coverId}', [CoverController::class, 'show'])->name('api.covers.show');
        Route::patch('covers/{coverId}', [CoverController::class, 'update'])->name('api.covers.patch');
    });
});
