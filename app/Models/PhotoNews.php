<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoNews extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $fillable = [
        'is_Active',
        'title',
        'url',
        'image',
        'description',
        'keywords',
        'copyright',
        'order_by_no',
        'created_by',
        'update_by',
    ];

    

}
