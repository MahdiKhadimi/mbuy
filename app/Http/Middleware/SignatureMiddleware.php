<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SignatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$header_name='X-Header')
    {
        $response = $next($request);

        $response->header($header_name,config('app.name'));
        
        return $response;
    }
}