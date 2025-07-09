<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendArticleCategory extends Model
{
    // If your table is named differently, uncomment and set it:
    // protected $table = 'frontend_article_categories';

    // Which columns you allow mass‐assign
    protected $fillable = [
        'slug',
        'name',
        'image',          // if you store a filename there
    ];

    /**
     * The articles in this category.
     */
    public function articles()
    {
        return $this->belongsToMany(
            FrontendArticle::class,
            'frontend_article_category',         // pivot table
            'frontend_article_category_id',      // this model’s FK
            'frontend_article_id'                // the article FK
        );
    }
}
