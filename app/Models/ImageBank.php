<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageBank extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','uuid');
    }
        
    public function news_photo_id(){
        return $this->hasMany(PhotoNews::class, 'photo_id');
    }

}
