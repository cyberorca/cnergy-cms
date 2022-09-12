<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('roles',
            ['roles' => $roles]);
    }

    public function create()
    {

    }

    public function store(RoleRequest $request)
    {
        $data = $request->input();
        $role = new Role([
            'role' => strtoupper($data['role'])
        ]);
        try {
            $role->save();
            return Redirect::back()->with('status', 'SUCCESS');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(RoleRequest $request, $id)
    {
        $data = $request->input();
            try {
                Role::where('id', $id)->update(['role' => strtoupper($data['role'])]);
                return Redirect::back()->with('status', 'SUCCESS');
            } catch (\Throwable $e) {
                return Redirect::back()->withErrors($e->getMessage());
            }
    }

    public function destroy($id)
    {
        try {
            Role::destroy($id);
            return Redirect::back()->with('status', 'SUCCESS');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }

    }
}
