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
        Route::apiResource('chapters', ChapterController::class);
        Route::post('chapters/{chapterId}/blocks', [BlocksApi::class, 'bulkStore']);
        Route::get('chapters/{chapterId}/blocks', [BlocksApi::class, 'index']);
        Route::get('covers/{coverId}', [CoverController::class, 'show']);
        Route::put('covers/{coverId}', [CoverController::class, 'update']);
        Route::patch('v1/covers/{coverId}', [CoverController::class, 'update']);
    });
});
