<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $AuthUserRole= Auth::user()->role;

        switch($role){
            case 'admin':
                if($AuthUserRole==0){
                    return $next($request);
                }
                break;
            case 'vendor':
                if($AuthUserRole==1){
                    return $next($request);
                }
                break;
            case 'customer':
                if($AuthUserRole==2){
                    return $next($request);
                }
                break;
        }

        switch($AuthUserRole){
            case 0:
                    return redirect()->route('admin');
                break;
            case 1:
                    return redirect()->route('vendor');
                break;
            case 2:
                    return redirect()->route('dashboard');
                break;
        }
        return redirect()->route('login');
    }
}
