<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'role'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = false;


    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'roles_menus');
    }

    public function isExistRole($role){
        return Role::where('role', '=', $role)->exists();
    }

    public function saveRole($role){
        $role = new Role([
            'role' => ucwords($role)
        ]);
        $role->save();
        return $role;
    }

    public function updateRole($id,$role){
        $roleById = Role::find($id);
        $roleById->update(['role' => ucwords($role)]);
        return $roleById;
    }

    public function findRoleByRole($role){
        $roles = Role::query();
        if (!empty($role)) {
            $roles->where('role', 'like', '%' . $role . '%');
        }
        return $roles;
    }

    public function findRoleById($id){
        $role = Role::find($id);
        return $role;
    }

    public function deleteRole($id){
        return Role::destroy($id);
    }

    public function deleteAccessRoleById($id){
       return Role::find($id)->menus()->detach();
    }

    //    public function menusByRoleId($id)
    //    {
    //        $data = Role::with('menus')->Where('id','=',$id)->get()->pluck('menus');
    //        return $data;
    //    }

    // public function users()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
