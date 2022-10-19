<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticPage extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $deletedAt = ['deleted_at'];

    public function users()
    {
        return $this->hasOne(User::class,'uuid','created_by');
    }

}
