<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token =$request->header('APP_KEY');
        if($token != "c[C6)cZTat`umhd"){
            return response()->json(['message'=>'App key not found'],401);
        }
        return $next($request);
    }
}