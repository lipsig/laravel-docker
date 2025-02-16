<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\CampaignController;
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


//campaign routes
Route::middleware('auth:api')->group(function () {
    Route::post('campaigns', [CampaignController::class, 'store']);
    Route::get('campaigns', [CampaignController::class, 'index']);
    Route::get('campaigns/{id}', [CampaignController::class, 'show']);
    Route::put('campaigns/{id}', [CampaignController::class, 'update']);
    Route::delete('campaigns/{id}', [CampaignController::class, 'destroy']);
});