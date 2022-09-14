<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class C_Users extends Controller
{
    public function index()
    {
    	$users = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->get();
    	return view('home_user',['users' => $users]);
    }
}
