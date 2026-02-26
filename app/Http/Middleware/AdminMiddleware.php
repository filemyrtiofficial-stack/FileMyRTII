<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;

class AdminMiddleware
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
        if(!Auth::check()) {

            return  Redirect::to('/login');

        }
        else {
            if(Auth::user()->status == 1) {

                return $next($request);
            }
            Auth::logout();
            return  Redirect::to('/login');

            
        }
    }
}
