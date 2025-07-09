<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="FrontendArticle",
 *     type="object",
 *     title="FrontendArticle",
 *     required={"id", "title"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Ziņa par API"),
 *     @OA\Property(property="slug", type="string", example="Ziņa par API"),
 *     @OA\Property(property="published_from", type="string", example="01.01.2024"),
 *     @OA\Property(property="published_to", type="string", example="31.12.2024"),
 *     @OA\Property(property="images", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="video", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="tag", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="attachments", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="banners", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="categories", type="array", @OA\Items(type="string")),
 *     @OA\Property(property="content", type="array", @OA\Items(type="string")),
 * )
 */
class FrontendArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'slug'          => $this->slug,
            'title'          => $this->title,
            'published_from' => $this->published_from,
            'published_to'   => $this->published_to,
            'images'         => $this->images,
            'video'          => $this->video,
            'tag'            => $this->tag,
            'attachments'    => $this->attachments,
            'banners'        => $this->banners,
            'category_ids'   => $this->categories->pluck('id'),
            'categories'     => $this->categories->map(fn($c) => [
            'id'   => $c->id,
            'name' => $c->name,
            'slug' => $c->slug,
        ]),
            'content' => $this->content,
        ];
    }
}
