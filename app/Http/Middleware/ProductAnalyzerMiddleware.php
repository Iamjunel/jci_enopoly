<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProductAnalyzerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check()) {
            if (auth()->user()->type == 'product_analyzer') {
                //auth()->logout();
                return $next($request);
                
            }
        auth()->logout();    
        return response()->view('pages-403');
        }
        auth()->logout();
       return response()->view('pages-404');
    }
}