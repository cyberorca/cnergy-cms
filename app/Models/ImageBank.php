<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ImageBank extends Model
{
    use HasFactory, SoftDeletes,LogsActivity;

    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','uuid');
    }

    public function news_photo_id(){
        return $this->hasMany(PhotoNews::class, 'photo_id');
    }

    protected $recordEvents = ['created', 'updated', 'deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} image";
    }

    public function getLogNameToUse(): ?string
    {
        return "image";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
