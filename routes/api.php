<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TagController;

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

Route::post('auth/register' ,[AuthController::class , 'register']);
Route::post('auth/login' ,[AuthController::class , 'login'])->name('login');
Route::post('auth/forgot', [AuthController::class , 'forgot']);
Route::post('auth/reset', [AuthController::class, 'reset']);


Route::middleware('auth:api')->group( function () {
    Route::resource('users', UserController::class);
    Route::get('auth/me', [AuthController::class , 'profile']);
    Route::resource('articles', ArticleController::class);
    Route::resource('tags', TagController::class);
});