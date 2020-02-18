<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;

class adminAccountAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $account = $request->header('account');
        $password = $request->header('password');
        $keycode = $request->header('keycode');
        if( $user = Admin::where('account', $account)->first()){
            if ($user['password'] == $password && $user['key'] == $keycode) {
                return $next($request);
            }
        }
        return response()->json(['message'=>'not valid admin account'],401);
    }
}
