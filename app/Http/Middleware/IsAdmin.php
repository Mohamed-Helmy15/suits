<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    
    // Check if the user's name matches 'mohamed helmy' (case-insensitive)
    if ($request->user()->role !== 'admin') {
        return abort(403); // Forbidden
    }
    
    return $next($request); // Allow access
    }
}
