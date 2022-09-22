<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class RoleController extends Controller
{


    public function index(Request $request)
    {
        $roles = Role::query();

        if ($request->get('inputRole')) {
            $roles->where('role', 'like', '%' . $request->inputRole . '%');
        }
        return view('admin.role.index',
            ['roles' => $roles->paginate(10)->withQueryString()]);
    }

    public function create()
    {
        $menus = Menu::whereNull('parent_id')->with(["childMenus", "roles"])->get();
        return view('admin.role.create', compact('menus'));
    }

    public function store(RoleRequest $request)
    {
        $data = $request->input();
        $menusIdChild = $request->checkMenuChild; //[][]
        $role = new Role([
            'role' => ucwords($data['role'])
        ]);

        try {
            $role->save();
            foreach ($menusIdChild as $menuKeyParent => $menuChild) {
                if (sizeof($menuChild) == 1) {
                        $role->menus()->attach($menuKeyParent);
                } else {
                    foreach ($menuChild as $menuKey => $menuValue) {
                        $role->menus()->attach((int)$menuValue);
                    }
                }
            }
            return \redirect('role')->with('status', 'Successfully Add New Role');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        $menus = Menu::whereNull('parent_id')->with(["childMenus", "roles"])->get();

        return view('admin.role.update', compact(["role", "menus"]));
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();
        $menusIdChild = $request->checkMenuChild; //[][]
        try {
            $roleById = Role::find($id);
            $role = $roleById->update(['role' => ucwords($data['role'])]);
            foreach ($menusIdChild as $menuKeyParent => $menuChild) {
                if (sizeof($menuChild) == 1) {
                    $roleById->menus()->sync($menuKeyParent,false);
                } else {
                    foreach ($menuChild as $menuKey => $menuValue) {
                        $roleById->menus()->sync((int)$menuValue,false);
                    }
                }
            }

            return redirect("role")->with("status", "Successfully to Update Role ");
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Role::destroy($id);
            return Redirect::back()->with('status', 'Successfully to Delete Role');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
