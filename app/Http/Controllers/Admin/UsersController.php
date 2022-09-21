<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Utils\SendEmailToNewUsers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with(['roles']);

        if ($request->get('inputEmail')) {
            $users->where('email', 'like', '%' . $request->inputEmail . '%');
        } 

        if ($request->get('inputName')) {
            $users-> where('name', 'like', '%' . $request->inputName . '%');
        }
        if ($request->get('role')) {
            $role = $request->role;
            $users ->where('role_id',$role);
        }

        if ($request->get('status')) {
            $status = $request->status;
            if($status == 2) {
                $users ->where('is_active', "0");
            }else {
                $users ->where('is_active', "1");
            }

        }

        return view('admin.users.index', [
            'users' => $users->paginate(10)->withQueryString(),
            'roles' => Role::all()
        ]);
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->role;
        $roles = Role::all();
    		// mengambil data dari table pegawai sesuai pencarian data
		$users = User::with(['roles'])
		->where('role_id',$cari)
		->get();
 
        return view('admin.users.index', compact('users', 'roles'));
 
	}


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->input();
        $user = new User([
            'name' => ucwords($data['name']),
            'email' => $data['email'],
            'role_id' => $data['role'],
            'remember_token' => Str::random(100),
        ]);
        try {
            $user->save();
            SendEmailToNewUsers::makeMail($user);
            return redirect('users')->with('status', 'Successfully to Add User');
        } catch (\Throwable $e) {
            return redirect('users')->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = User::where('uuid', $id)->with(['roles'])->first();
        $roles = Role::all();
        return view('admin.users.update', compact('roles'))->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->input();
        
            try {
                User::where('uuid',$id)->update([
                    'name' => ucwords($data['name']),
                    'email' => $data['email'],
                    'role_id' => $data['role'],
                    'is_active' => $data['is_active'],
                ]);
                return redirect('users')->with('status', 'Successfully to Update User');
            } catch (\Throwable $e) {
                return Redirect::back()->withErrors($e);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::destroy($id);
            return Redirect::back()->with('status', 'Successfully to Delete User');
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
