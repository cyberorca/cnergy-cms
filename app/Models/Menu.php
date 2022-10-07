<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['slug', 'menu_name', 'parent_id', 'created_at', 'updated_at', 'deleted_at'];

    public $array = [];

    public function child()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with("child");
    }

    public function childMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('childMenus');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function slug()
    {
        return $this->slug;
    }
    public function menu_name()
    {
        return $this->menu_name;
    }

    public function childs()
    {
        return $this->child;
    }

    public function count_childs()
    {
        return count($this->child) !== 0;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_menus');
    }

    public function roles_user()
    {
        return $this->belongsToMany(Role::class, 'roles_menus')->where('role_id', Auth::user()->role_id);
    }

    public static function getAll()
    {
        // return self::with('roles_user')->get()->toArray();
        $menu_role_user = self::with('roles_user')->get()->toArray();
        // $menu_role_user = self::all()->toArray();
        return self::convertMenuDataToResponse($menu_role_user);
    }

    public static function convertMenuDataToResponse($dataRaw)
    {
        $tree = array();
        $references = array();

        foreach ($dataRaw as $id => &$node) {
            $references[$node['id']] = &$node;
            $node['children'] = array();
            if(count($node['roles_user'])){
                if (is_null($node['parent_id'])) {
                    $tree[$node['id']] = &$node;
                } else {
                    $references[$node['parent_id']]['children'][$node['id']] = &$node;
                }
            }
        }

        return $tree;
    }
}
