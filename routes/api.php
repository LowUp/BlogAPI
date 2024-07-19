<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserIsAuthenticated;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Blog API endpoints to retrieve data from the database.
Route::apiResource('posts', PostController::class)
    ->only([
        'index',
        'show'
    ]);

Route::apiResource('posts', PostController::class)
    ->except([
        'index',
        'show'
    ])
    ->middleware(EnsureUserIsAuthenticated::class);


