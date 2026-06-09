<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AchievementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Achievements routes
Route::get('/achievements', [AchievementController::class, 'index']);
Route::get('/achievements/{id}', [AchievementController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/achievements', [AchievementController::class, 'store']);
    Route::put('/achievements/{id}', [AchievementController::class, 'update']);
    Route::delete('/achievements/{id}', [AchievementController::class, 'destroy']);
});
