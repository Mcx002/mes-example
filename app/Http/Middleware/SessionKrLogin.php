<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionKrLogin
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
        if(!Session::get('login')){
            return redirect()->route('kr_login');
        }
        return $next($request);
    }
}
