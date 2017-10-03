<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Request;

class LoginAuth
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
        if(!Auth::check())
            return redirect('/');
        else if(Auth::user()->rank < 3)
            return redirect('/logout');
        else if(Request::is('login') || Request::is('login/handle'))
            return redirect('/dashboard');
        return $next($request);
    }
}
