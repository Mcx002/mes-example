<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\User;

class IsKrAdmin
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
        if(Session::get('level')!='4'){
            return response()->view('errors.kr403', [], 403);
        }
        return $next($request);
    }
}
