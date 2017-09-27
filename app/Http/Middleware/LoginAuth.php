<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
            return redirect('logout');
        return $next($request);
    }
}
