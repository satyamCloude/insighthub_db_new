<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $allowedIps = Security::where('status',1)->pluck('User_ip_address')->toArray();
        if (!in_array($request->ip(), $allowedIps)) {
            return response()->view('errors.403', [], 403);
        }
        return $next($request);
    }
}