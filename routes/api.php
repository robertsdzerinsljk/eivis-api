<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendPageController;
use App\Http\Controllers\FrontendArticleController;
use App\Http\Controllers\API\FrontendArticleCategoryController;

Route::middleware('throttle:60,1')->group(function () {

    Route::get('frontend-pages', [FrontendPageController::class, 'index']);
    Route::get('frontend-pages/{slug}', [FrontendPageController::class, 'show']);

    Route::get('frontend-articles', [FrontendArticleController::class, 'index']);
    Route::get('frontend-articles/{slug}', [FrontendArticleController::class, 'show']);

    Route::get('frontend_article_categories', [FrontendArticleCategoryController::class, 'index']);

});
