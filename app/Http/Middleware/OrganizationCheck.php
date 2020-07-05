<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OrganizationCheck
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
        if (!$request->organization || Auth::user()->organization->id === $request->organization->id || Auth::user()->organization->id === $request->organization->parent_id) {
            return $next($request);
        }
        return abort(403);
    }
}
