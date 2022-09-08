<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guard = [];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'news_category');
    }
}
