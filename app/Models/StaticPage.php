<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class StaticPage extends Model
{
    use HasFactory, SoftDeletes ,LogsActivity;
    protected $guarded = [];

    protected $deletedAt = ['deleted_at'];

    public function users()
    {
        return $this->hasOne(User::class,'uuid','created_by');
    }

    protected $recordEvents = ['created', 'updated', 'deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} static page";
    }

    public function getLogNameToUse(): ?string
    {
        return "static page";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
