<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Session;

class CustomerMiddleware
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
        if(!Auth::guard('customers')->check()) {
            Session::put('request_url', $request->url());
            $new = explode("my-rtis/",$request->url());
            if(isset($new[1])) {
                 $new_array = explode("/",$new[1]);
                 if(isset($new_array[0])) {
                    $new_array[0] = encryptString($new_array[0]);
                    return  Redirect::to('track-rti/'.$new_array[0]."/".($new_array[1] ?? ''));
                 }
            }
            return  Redirect::to('/');

            // $new_array = explode("/",$new[1]);
            // $new_array[0] = encryptString($new_array[0]);
        
            
            //  return  Redirect::to('track-rti/'.$new_array[0]."/".($new_array[1] ?? ''));
         

        }
        else {
            return $next($request);
        }
    }
}
