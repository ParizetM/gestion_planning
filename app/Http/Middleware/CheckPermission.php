<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string[]  $permissions
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = Auth::user();
        if (in_array(needle: $user->permission->nom, haystack: $permissions)) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
