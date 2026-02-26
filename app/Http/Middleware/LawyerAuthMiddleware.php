<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
class LawyerAuthMiddleware
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
        if(!Auth::guard('lawyers')->check()) {

            Session::put('lawyer_request_url', $request->url());
            return  Redirect::to('/lawyer/login');

        }
        else {
              if(Auth::guard('lawyers')->user()->status == 1) {

                return $next($request);
            }
            Auth::guard('lawyers')->logout();
            return  Redirect::to('/lawyer/login');
        }
    }
}
