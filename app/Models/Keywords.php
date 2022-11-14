<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keywords extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keywords';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['keywords',  'is_active', 'created_at', 'created_by', 'deleted_by', 'deleted_at', 'updated_by', 'updated_by'];

    public function keywords(){
        return $this->belongsToMany(News::class, 'news_keywords')->withPivot('id');
    }

    public function news(){
        return $this->belongsToMany(News::class, 'news_keywords')->withPivot('id');
    }
}
