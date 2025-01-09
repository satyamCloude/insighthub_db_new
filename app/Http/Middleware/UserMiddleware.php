<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect('/');
        }

        // Check if the user has the "admin" type
        if (auth()->user()->type == '2') {
        return $next($request);
        }else{
             return redirect('/');
           // abort(403, 'Unauthorized');
        }

    }

}
