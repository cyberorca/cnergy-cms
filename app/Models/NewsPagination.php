<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsPagination extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'news_paginations';
    public $timestamps = false;
    protected $deletedAt = ['deleted_at'];
}
