<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect('/Employee');
        }

        // Check if the user has the "admin" type
        if (auth()->user()->type != '4') {
            return redirect('/Employee');
        }

        return $next($request);
    }
}
