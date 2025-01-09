<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Security;

class CheckIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Fetch allowed IP addresses from the database
        $allowedIps = Security::where('status', 1)->pluck('User_ip_address')->toArray();

        // If there are no allowed IP addresses, allow all IPs
        if (empty($allowedIps) || in_array($request->ip(), $allowedIps)) {
            return $next($request);
        }

        // If the IP is not allowed, return a 403 Forbidden response
        return response()->view('errors.403', [], 403);
    }
}
