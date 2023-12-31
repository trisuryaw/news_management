<?php

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

Route::resource('news', \App\Http\Controllers\NewsController::class)->middleware(['auth:api', 'admin']);
Route::get('/news', [\App\Http\Controllers\NewsController::class, 'index']);
Route::get('/user/{id}', [\App\Http\Controllers\NewsController::class, 'getToken']);

Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'index']);
