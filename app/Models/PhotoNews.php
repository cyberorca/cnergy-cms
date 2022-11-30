<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhotoNews extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $guarded = [];

    protected $table = 'photo_news';

    protected $primaryKey = 'id';

    protected $fillable = [
        'is_active',
        'title',
        'url',
        'image',
        'description',
        'keywords',
        'copyright',
        'order_by_no',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'news_id',
        'photo_id',
    ];

    protected $deletedAt = ['deleted_at'];
        
    public function id_image(){
        return $this->belongsTo(ImageBank::class, 'photo_id');
    }


}
