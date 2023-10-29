<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(checkRole(auth()->user(), [1])) {
            return $next($request);
        }

        if(checkRole(auth()->user(), [2,3,4])) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('panel-members.index');
        }
    }
}
