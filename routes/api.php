<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class, 'show']);
    Route::put('user', [UserController::class, 'update']);
    Route::delete('user', [UserController::class, 'destroy']);
});


//influencer routes
Route::middleware('auth:api')->group(function () {
    Route::post('influencers', [InfluencerController::class, 'store']);
    Route::get('influencers', [InfluencerController::class, 'index']);
    Route::get('influencers/{id}', [InfluencerController::class, 'show']);
    Route::put('influencers/{id}', [InfluencerController::class, 'update']);
    Route::delete('influencers/{id}', [InfluencerController::class, 'destroy']);
});
