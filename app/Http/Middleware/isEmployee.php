<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(checkRole(auth()->user(), [2,3,4])) {
            return $next($request);
        }

        if(checkRole(auth()->user(), [5])) {
            return redirect()->route('panel-members.index');
        } else {
            return redirect('/');
        }
    }
}
