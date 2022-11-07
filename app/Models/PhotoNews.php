<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoNews extends Model
{
    use HasFactory;

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
        'created_by',
        'updated_by',
        'updated_at',
        'news_id',
    ];

    

}
