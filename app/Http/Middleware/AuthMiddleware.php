<?php

namespace App\Http\Middleware;

use Closure;
use App\Member;
class AuthMiddleware
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
        $token = $request->header('Authorization');
        if($user = Member::where('api_token',$token)->first()){
            return $next($request);
        }else{
            return response()->json(['message'=>'not valid token'],401);
        }
    }
}
