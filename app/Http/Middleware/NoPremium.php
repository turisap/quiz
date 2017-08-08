<?php

namespace App\Http\Middleware;

use Closure;

class NoPremium
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
        if (auth()->check()) {
            if (auth()->user()->premium != 1) {
                return $next($request);
            }
        }
        return redirect()->home();
    }
}
