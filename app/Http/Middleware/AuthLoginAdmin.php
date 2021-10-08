<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthLoginAdmin
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
        if (getLoggedInUser()) {
            return $next($request);
        } else {
            return redirect()->route('admin.login-page');
        }
    }
}
