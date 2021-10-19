<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheckManagerLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isManagerLogged()) {
            return redirect()->route('admin.dashboard.index');
        }
        return $next($request);
    }
}
