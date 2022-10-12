<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'news_id',
        'updated_by',
        'updated_content'
    ];

}
