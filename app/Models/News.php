<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guard = [];

    protected $table = 'news';

    protected $primaryKey = 'id';

    protected $fillable = [
        'is_headline',
        'title',
        'slug',
        'types',
        'image',
        'video ',
        'synopsis',
        'content'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'news_tag'); 
    }
}
