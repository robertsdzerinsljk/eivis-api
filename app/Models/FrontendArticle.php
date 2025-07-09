<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendArticle extends Model
{

    protected $guarded = [];

    public function getPublishedFromAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : '';
    }

    public function getPublishedToAttribute($value)
    {
        return $value ? date('d.m.Y', strtotime($value)) : '';
    }

    public function setPublishedFromAttribute($value)
    {
        return $this->attributes['published_from'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    public function setPublishedToAttribute($value)
    {
        return $this->attributes['published_to'] = $value ? date('Y-m-d', strtotime($value)) : null;
    }

    protected $casts = [
        'images' => 'array',
        'video' => 'array',
        'tag' => 'array',
        'attachments' => 'array',
        'banners' => 'array',
        'categories' => 'array',
        'published_from' => 'date',  
        'published_to' => 'date',  
    ];

    public function page()
    {
        return $this->hasOne(FrontendPage::class, 'id', 'page_id');
    }

    public function articleCategories()
    {
         return $this->belongsToMany(FrontendArticleCategory::class, 'frontend_article_category', 'frontend_article_id', 'frontend_article_category_id');
    }
}
