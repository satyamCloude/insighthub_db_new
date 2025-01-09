<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect('/admin');
        }

        // Check if the user has the "admin" type
        if (auth()->user()->type == '1') {
        return $next($request);
        }else{
             return redirect('/admin');
            //abort(403, 'Unauthorized');
        }

    }

    
}
