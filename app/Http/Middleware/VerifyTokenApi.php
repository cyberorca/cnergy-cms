<?php

namespace App\Http\Middleware;

use App\Models\FrontEndSetting;
use Closure;
use Illuminate\Http\Request;

class VerifyTokenApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return response()->json($request->get('token'));
        if(!$request->get('token')){
            return response()->json([
                "message" => "The security token missing from your request"
            ], 400);
        }
        
        $token = FrontEndSetting::first(['token'])->token;
        $arr_token = array_values(json_decode($token, true));
        
        if(!in_array($request->get('token'), $arr_token)){
            return response()->json([
                "message" => "The security token is invalid"
            ], 400);
        }
        
        return $next($request);
    }
}
