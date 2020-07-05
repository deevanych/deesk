<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IssueCheck
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
        if ($request->get('organization') && $request->get('organization') === Auth::user()->organization->id) {
            return $next($request);
        } elseif (!$request->issue) {
            return $next($request);
        } elseif (Auth::user()->organization->id === $request->issue->organization_id || Auth::user()->organization->id === $request->issue->author_organization_id) {
            return $next($request);
        }

        return abort(403);
    }
}
