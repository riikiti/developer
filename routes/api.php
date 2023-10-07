<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\FavoritesController;
use App\Http\Controllers\Api\UnselectedController;



Route::apiResources([
    'users'=>UserController::class,
    'movie'=>MovieController::class,
    'favorites'=>FavoritesController::class,
]);
Route::get('/unselected',  UnselectedController::class);

