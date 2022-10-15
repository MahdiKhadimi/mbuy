<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TransformInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$transformer)
    {
        $transfor_data = [];
        foreach ($request->request->all() as $input => $value) {

            $transfor_data[$transformer::original_attribute($input)]=$value;
       
        }
        
        $request->replace($transfor_data);
        
        return $next($request);
    }
}