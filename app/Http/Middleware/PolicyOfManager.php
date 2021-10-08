<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;

class PolicyOfManager
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
        if (getAccountInfo()->role == Account::NAME_ROLE_ADMIN) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
