<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="FrontendArticleList",
 *     type="object",
 *     title="FrontendArticle",
 *     required={"slug", "title"},
 *     @OA\Property(property="slug", type="string", example="article-slug"),
 *     @OA\Property(property="title", type="string", example="Article Title"),
 *     @OA\Property(property="introduction", type="string", example="Short introduction..."),
 *     @OA\Property(property="image", type="string", example="https://example.com/image.jpg"),
 *     @OA\Property(property="published_from", type="string", format="date", example="2025-07-01"),
 *     @OA\Property(property="highlited", type="integer", example=0)
 * )
 */
class FrontendArticleListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'slug'           => $this->slug,
            'title'          => $this->title,
            'introduction'   => $this->introduction,
            'image'          => $this->image,
            'published_from' => $this->published_from,
            'content'        => $this->content,
            'highlighted'      => (int) $this->highlighted,
            'image_url'    => $this->image_url,
            'category_ids'   => $this->articleCategories->pluck('id')->all(),
            'categories'     => FrontendArticleCategoryResource::collection($this->articleCategories),
        ];
    }
}
