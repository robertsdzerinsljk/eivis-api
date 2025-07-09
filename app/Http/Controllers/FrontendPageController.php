<?php

namespace App\Http\Controllers;

use App\Http\Resources\FrontendPageResource;
use App\Models\FrontendPage;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="EIVIS API",
 *     description="REST API dokumentācija EIVIS sistēmai"
 * )
 */
class FrontendPageController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/frontend-pages",
     *     summary="Saņem visas frontend lapas",
     *     tags={"FrontendPages"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Veiksmīgi",
     *
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/FrontendPage"))
     *     ),
     *
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function index()
    {
        $pages = FrontendPage::with(['childs.childs'])->get();

        return FrontendPageResource::collection($pages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/frontend-pages/{id}",
     *     summary="Saņem konkrētu frontend lapu",
     *     tags={"FrontendPages"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Veiksmīgi",
     *
     *         @OA\JsonContent(ref="#/components/schemas/FrontendPage")
     *     ),
     *
     *     @OA\Response(response=404, description="Lapa nav atrasta"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
    public function show(string $slug)
    {
        $page = FrontendPage::with(['childs.childs'])
            ->where('slug', $slug)
            ->firstOrFail();

        return new FrontendPageResource($page);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FrontendPage $frontendPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FrontendPage $frontendPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FrontendPage $frontendPage)
    {
        //
    }
}
