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

    public static function getAll()
    {
        $data = [];
        $inventory = self::all()->makeHidden(['created_at', 'created_by', 'updated_at', 'updated_by'])->toArray();
        foreach (array_keys(config('inventory')) as $item) {
            $data[$item] = [];
        }
        foreach ($inventory as $item) {
            $item['creative_size'] = $item['size'];
            unset($item['size']);
            array_push($data[$item['type']], $item);
        }
        return $data;
    }
}
