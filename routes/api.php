<?php

use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])
        ->middleware('auth:sanctum');
});

Route::apiResource('stories', StoryController::class)
    ->only(['index', 'store', 'show', 'edit', 'update', 'destroy'])
    ->middleware('auth:sanctum');

Route::get('following', [StoryController::class, 'following'])->middleware('auth:sanctum');

Route::post('/follows', [UserController::class, 'follows'])->middleware('auth:sanctum');
Route::post('/unfollows', [UserController::class, 'unfollows'])->middleware('auth:sanctum');

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth:sanctum');
Route::get('/user/settings', [ProfileController::class, 'settings'])->middleware('auth:sanctum');
Route::post('/user/update', [ProfileController::class, 'updateInfos'])->middleware('auth:sanctum');

Route::get('/{username}', [UserController::class, 'userPage'])->middleware('auth:sanctum');

Route::get('image/{path}', [ImageController::class, 'getImage'])->where('path', '.*');
