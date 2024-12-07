<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// Auth routes

// Public routes
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article}', [ArticleController::class, 'show']);
Route::get('/quotes', [QuoteController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('articles', ArticleController::class)->except(['index', 'show']);
    Route::apiResource('quotes', QuoteController::class)->except(['index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
