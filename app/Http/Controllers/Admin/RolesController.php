<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $data = $request->input();
        $validator = Validator::make($data, [
            'role' => 'required|unique:roles'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return Redirect::back()->withErrors($errors);
        } else {
            $role = new Role([
                'role' => strtoupper($data['role'])
            ]);
            try {
                $role->save();
                return Redirect::back()->with('status', 'SUCCESS');
            } catch (\Throwable $e) {
                return Redirect::back()->withErrors($e);
            }

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

    public function update(Request $request, $id)
    {
        $data = $request->input();
        $validator = Validator::make($data, [
            'role' => 'required|unique:roles'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return Redirect::back()->withErrors($errors);
        } else {
            try {
                Role::where('id',$id)->update(['role'=>strtoupper($data['role'])]);
                return Redirect::back()->with('status', 'SUCCESS');
            } catch (\Throwable $e) {
                return Redirect::back()->withErrors($e);
            }
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
