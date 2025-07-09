<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FrontendPage extends Model
{
     protected $guarded = [];

    protected $casts = [
        'categories' => 'array',
    ];

        public function articles(): HasMany
    {
        return $this->hasMany(FrontendArticle::class, 'page_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childs(): HasMany
    {
        return $this->children()->with('childs');
    }
}
