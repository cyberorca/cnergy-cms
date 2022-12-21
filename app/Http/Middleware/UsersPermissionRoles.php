<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersPermissionRoles
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$active)
    {
//        if (in_array(auth()->user()->roles['role'],$roles)){
//            return $next($request);
//        }


//        if (auth()->user() != null) {
//            if (auth()->user()->is_active = $active) {
//                return $next($request);
//            }
//        }

        if (auth()->user() != null) {
            if (Auth::check() && Auth::User()->is_active == 0) {
                Auth::logout();
                return redirect()->to('/login')->withErrors(['error'=> 'Your session has expired because your status change.']);
            }
            if (auth()->user()->is_active = $active) {
                return $next($request);
            }
        }
        return redirect()->to('/login')->withErrors(['error'=> 'Login Failed.']);
    }
}
