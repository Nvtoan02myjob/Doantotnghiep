<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkAdminRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            if(auth()->user()->role_id == 3){
                return $next($request);

            }else{
                return redirect('/')->with('errorInPageAdmin', 'Bạn không có quyền truy cập.');
            }

        }else{
            return redirect()->route('login'); 
        }
    }
}
