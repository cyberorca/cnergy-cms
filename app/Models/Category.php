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
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    // protected $casts = [
    //     'types' => 'array',
    // ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_category');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id')->select('id', 'parent_id', 'category', 'types', 'slug');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childCategory()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('child.parent.child.parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('child.child');
    }

    public function slug()
    {
        return $this->slug;
    }

    public function menu_name()
    {
        return $this->category;
    }

    public function childs()
    {
        return $this->child;
    }

    public function setTypesAttribute($value)
    {
        $this->attributes['types'] = json_encode($value);
    }

    public function getTypesAttribute($value)
    {
        return json_decode($value, true);
    }

    public static function getAll()
    {
        $category = self::select("*", "category as menu_name", "parent_id as parent")->get()->toArray();
        return self::convertCategoryDataToResponse($category);
    }

    public static function convertCategoryDataToResponse($dataRaw)
    {
        $tree = [];
        $references = [];

        foreach ($dataRaw as $id => &$node) {
            $references[($node['id'])] = &$node;
            $node['children'] = array();
            if (is_null($node['parent'])) {
                $tree[($node['id'])] = &$node;
            } else {
                $references[$node['parent']]['children'][($node['id'])] = &$node;
            }
        }

        return array_values(self::array_values_recursive($tree));
    }

    public static function convertCategoryDataToResponseAPI($dataRaw)
    {
        $tree = [];
        $references = [];

        foreach ($dataRaw['data'] as $id => &$node) {
            $references[($node['id'])] = &$node;
            $node['children'] = array();
            if (is_null($node['parent'])) {
                $tree[($node['id'])] = &$node;
            } else {
                $references[$node['parent']]['children'][($node['id'])] = &$node;
            }
        }

        return array_values(self::array_values_recursive($tree));
    }


    public static function array_values_recursive($arr)
    {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $arr[$key] = self::array_values_recursive($value);
            }
        }

        if (isset($arr['children'])) {
            $arr['children'] = array_values($arr['children']);
        }

        return $arr;
    }
}
