<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  array<string>  $permissions
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = Auth::user();
        if (in_array(needle: $user->permission->nom, haystack: $permissions)) {
            return $next($request);
        }
        abort(403);
    }
}
