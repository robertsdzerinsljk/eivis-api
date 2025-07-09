<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FrontendArticleCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
          'id'   => $this->id,
          'slug' => $this->slug,
          'name' => $this->name,
          // if you store an image filename on the category model:
          'image'     => $this->image,
           // <<< add this:
          'image_url' => $this->image
               ? url('photos/category-icons/' . $this->image)
               : null,
        ];
    }
}
