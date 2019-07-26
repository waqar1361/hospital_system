<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PatientManageMiddleware
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
        if (Auth()->check())
        {
            if (Auth::user()->type == 'admin' ||
                Auth::user()->type == 'doctor'||
                Auth::user()->type == 'nurse')
             {
                return $next($request);
            }
            return abort(403);
        }
        return redirect()->route('login');
    }
}
