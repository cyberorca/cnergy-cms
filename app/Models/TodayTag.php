<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayTag extends Model
{
    use HasFactory;

    protected $table = 'today_tag';

    protected $primaryKey = 'id';
}
