<?php

namespace App\Http\Middleware;

use Closure;

class Teacher
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
            if (auth()->user()->teacher != 1) {
                session()->flash('message', 'You need to be a teacher to access the requested page');
                return redirect()->home();
            }
        }
        return $next($request);
    }
}