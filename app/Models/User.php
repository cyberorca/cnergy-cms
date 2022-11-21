<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';

    protected $primaryKey = 'uuid';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'email',
        'role_id',
        'is_active',
        'remember_token',
        'profile_image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'uuid' => 'string',
    ];

    public $timestamps = false;

    public function roles(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $model->uuid = Str::uuid();
    });
}
}
