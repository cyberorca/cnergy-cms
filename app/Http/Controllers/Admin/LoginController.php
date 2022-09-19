<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index(){
        if (\auth()->id()!=null){
            return redirect('/');
        }else{
            return view('admin.login.index');
        }
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user_google_email = Socialite::driver('google')->user()->getEmail();
            $user = User::where([
                'email'=> $user_google_email,
                'is_active'=>'1'
                ])->first();
            if ($user != null){
                \auth()->loginUsingId($user['uuid']);
                return redirect()->intended('/');
//            dd(\auth()->user()->roles['role']);
            }else{
                return redirect('login');
            }
        } catch
        (\Exception $e) {
            return redirect('login');
        }
    }

    public function logout(){
        User::where('uuid', Auth::user()->getAuthIdentifier())->update(['last_logged_in' => now()]);
        \auth()->logout();
        return redirect('login');
    }
}
