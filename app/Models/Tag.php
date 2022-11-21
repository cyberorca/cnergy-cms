<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tags';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['tags', 'slug', 'is_active', 'created_at', 'created_by', 'deleted_by', 'meta_title', 'meta_description', 'meta_keywords'];

    public function tags(){
        return $this->belongsToMany(News::class, 'news_tags')->withPivot('id');
    }

    public function news(){
        return $this->belongsToMany(News::class, 'news_tags')->withPivot('id');
    }
}
