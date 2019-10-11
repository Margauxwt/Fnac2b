<?php

namespace App\Http\Middleware;

use Closure;

class ServiceAcheteurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->type != 'service_Acheteur')
        {
            return new Response(view('unauthorized')->with('role', 'service_Acheteur'));
        }
        return $next($request);
    }
}
