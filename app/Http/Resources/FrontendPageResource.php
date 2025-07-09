<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="FrontendPage",
 *     type="object",
 *     title="FrontendPage",
 *     required={"id", "title", "slug"},
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Sākumlapa"),
 *     @OA\Property(property="slug", type="string", example="sakumlapa"),
 *     @OA\Property(property="categories", type="array", @OA\Items(type="string")),
 *     @OA\Property(
 *         property="articles",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/FrontendArticle")
 *     ),
 *
 *     @OA\Property(
 *         property="childs",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/FrontendPage")
 *     )
 * )
 */
class FrontendPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'categories' => $this->categories,
            'content' => $this->content,
            'childs' => FrontendPageResource::collection($this->whenLoaded('childs')),
        ];
    }
}
