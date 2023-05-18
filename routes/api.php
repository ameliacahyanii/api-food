<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Routing\RouteGroup;

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

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/me', [AuthenticationController::class, 'me']);
    Route::post('/foods', [FoodController::class, 'store']);
    Route::patch('/foods-update/{id}', [FoodController::class, 'update'])->middleware('food-post-owner');
    Route::delete('/foods/{id}', [FoodController::class, 'delete'])->middleware('food-post-owner');
    Route::post('/review', [ReviewController::class, 'store']);
    Route::patch('/review/{id}', [ReviewController::class, 'update'])->middleware('review-owner');
    Route::delete('/review/{id}', [ReviewController::class, 'delete'])->middleware('review-owner');
});


Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/{id}', [FoodController::class, 'show']);
Route::post('/login', [AuthenticationController::class, 'login']);


// Route::get('/foods2/{id}', [FoodController::class, 'show2']);
// Route::get('/foods', [FoodController::class, 'index'])->middleware(['auth:sanctum']);
// Route::get('/foods/{id}', [FoodController::class, 'show'])->middleware(['auth:sanctum']);



