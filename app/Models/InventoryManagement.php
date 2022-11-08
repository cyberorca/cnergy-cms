<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryManagement extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'inventory_management';

    protected $primaryKey = 'id';

    protected $fillable = [
        'inventory',
        'slot_name',
        'type',
        'code',
        'template_id',
        'placement_id',
        'size',
        'adunit_size',
        'created_by',
        'updated_by',
    ];
}
