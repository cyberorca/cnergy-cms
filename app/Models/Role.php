<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'role'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = false;
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    // public function users()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
