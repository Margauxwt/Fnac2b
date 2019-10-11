<?php

namespace App\Http\Middleware;

use Closure;

class ServiceVenteMiddleware
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
        if ($request->user() && $request->user()->type != 'service_Vente')
        {
            return new Response(view('unauthorized')->with('role', 'service_Vente'));
        }
        return $next($request);
    }
}
