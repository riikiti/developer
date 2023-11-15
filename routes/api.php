<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\UnselectedController;


// UserController
Route::middleware(['user-found', 'user-rule'])->group(function () {
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);
});
Route::post('users', [UserController::class, 'store'])->withoutMiddleware('user-auth');
Route::get('users', [UserController::class, 'index']);

// MovieController
Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/{movie}', [MovieController::class, 'show'])->middleware('movie-found');

// FavoritesController
Route::get('favorites', [FavoritesController::class, 'index']);
Route::post('favorites', [FavoritesController::class, 'store']);
Route::delete('favorites/{favorite}', [FavoritesController::class, 'destroy']);

// UnselectedController
Route::get('/unselected', UnselectedController::class)->withoutMiddleware('user-auth');

