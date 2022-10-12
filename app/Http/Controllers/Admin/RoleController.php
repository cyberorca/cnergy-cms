<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class RoleController extends Controller
{
    private $roleModel ;
    public function __construct(Role $roleModel)
    {
        $this->roleModel = $roleModel;
    }

    public function index(Request $request)
    {
        $roles = $this->roleModel->findRoleByRole($request->get('inputRole'));
        return view('admin.role.index',
            ['roles' => $roles->paginate(10)->withQueryString()]);
    }

    public function create()
    {
        $method = explode('/', URL::current());
        $menus = Menu::whereNull('parent_id')->with(["childMenus", "roles"])->get();
        return view('admin.role.editable', ['method' => end($method)])->with('menus', $menus);
    }

    public function store(RoleRequest $request)
    {
        $data = $request->input();
        $menusIdChild = $request->checkMenuChild; //[][]
        try {

            $role = $this->roleModel->saveRole($data['role']);

            if ($menusIdChild != null) {
                foreach ($menusIdChild as $menuKeyParent => $menuChild) {
                    if (sizeof($menuChild) == 1) {
                        $role->menus()->attach($menuKeyParent);
                    } else {
                        foreach ($menuChild as $menuKey => $menuValue) {
                            $role->menus()->attach((int)$menuValue);
                        }
                    }
                }
            }

            return redirect()->route('role.index')->with('status', 'Successfully Add New Role');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $method = explode('/', URL::current());
        $role = $this->roleModel->findRoleById($id);
        $menus = Menu::whereNull('parent_id')->with(["childMenus", "roles"])->get();
        return view('admin.role.editable', ['method' => end($method)])->with('menus', $menus)->with('role',$role);
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();
        $menusIdChild = $request->checkMenuChild; //[][]

        try {
            if (($this->roleModel->isExistRole($data['role'])) == false){
                $roleById = $this->roleModel->updateRole($id,$data['role']);
            }
            $this->roleModel->deleteAccessRoleById($id);
            if ($menusIdChild != null) {
                foreach ($menusIdChild as $menuKeyParent => $menuChild) {
                    if (sizeof($menuChild) == 1) {
                        $roleById->menus()->attach($menuKeyParent);
                    } else {
                        foreach ($menuChild as $menuKey => $menuValue) {
                            $roleById->menus()->attach((int)$menuValue);
                        }
                    }
                }
            }

            return redirect()->route('role.index')->with("status", "Successfully to Update Role ");
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
           $this->roleModel->deleteRole($id);
            return Redirect::back()->with('status', 'Successfully to Delete Role');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
