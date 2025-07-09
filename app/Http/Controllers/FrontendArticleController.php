<?php

namespace App\Http\Controllers;

use App\Models\FrontendArticle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\FrontendArticleListResource;

class FrontendArticleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/frontend-articles",
     *     summary="Saņem visus rakstus",
     *     tags={"FrontendArticle"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Veiksmīgi",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/FrontendArticle"))
     *     )
     * )
     */
    public function index(): JsonResponse
{
    // 1) Get _all_ articles again
    $articles = FrontendArticle::all();

    // 2) Build the resource collection
    $resourceCollection = FrontendArticleListResource::collection($articles);

    // 3) (optional) still emit a preload hint for the first 3 images
    $firstImages = $articles
        ->pluck('image')
        ->filter()
        ->take(3)
        ->values();

    $linkHeader = $firstImages
        ->map(fn(string $url) => "<{$url}>; rel=preload; as=image")
        ->implode(', ');

    // 4) Return everything, with your preload + cache headers
    return $resourceCollection
        ->response()
        ->header('Link', $linkHeader)
        ->header('Cache-Control', 'public, max-age=300');
}


    /**
     * @OA\Get(
     *     path="/api/frontend-articles/{slug}",
     *     summary="Saņem vienu rakstu pēc ID",
     *     tags={"FrontendArticle"},
     *
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(response=200, description="Veiksmīgi",
     *         @OA\JsonContent(ref="#/components/schemas/FrontendArticle")
     *     ),
     *     @OA\Response(response=404, description="Nav atrasts")
     * )
     */
    public function show($slug)
    {
        $article = FrontendArticle::where('slug', $slug)->firstOrFail();

        return new \App\Http\Resources\FrontendArticleResource($article);
    }
}
