<?php
// app/Http/Controllers/API/FrontendArticleCategoryController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FrontendArticleCategory;
use App\Http\Resources\FrontendArticleCategoryResource;

class FrontendArticleCategoryController extends Controller
{
    /**
     * GET /api/frontend_article_categories
     */
    public function index()
    {
        // pull all categories (load image or articles if you need)
        $cats = FrontendArticleCategory::all();

        // return them as resources
        return FrontendArticleCategoryResource::collection($cats);
    }
}
