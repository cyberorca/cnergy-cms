<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $deletedAt = ['deleted_at'];

    protected $fillable = [
        'is_active',
        'category',
        'common',
        'parent_id',
        'slug',
        'types',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_category');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childCategory()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('child.parent.child.parent');
    }

    public function slug(){
        return $this->slug;
    }
    public function menu_name(){
        return $this->category;
    }

    public function childs(){
        return $this->child;
    }

}
