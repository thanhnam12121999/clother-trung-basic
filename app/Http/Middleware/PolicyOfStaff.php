<?php

namespace App\Http\Middleware;

use App\Models\Manager;
use Closure;
use Illuminate\Http\Request;

class PolicyOfStaff
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
        if (getAccountInfo()->role == (Manager::NAME_ROLE_ADMIN) || getAccountInfo()->role == (Manager::NAME_ROLE_MANAGER)) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
