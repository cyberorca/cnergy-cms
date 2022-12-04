<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FrontEndSetting extends Model
{
    use HasFactory,LogsActivity;

    protected $guarded = [];

    protected $recordEvents = ['created', 'updated', 'deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} fronted setting";
    }

    public function getLogNameToUse(): ?string
    {
        return "frontend setting";
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
