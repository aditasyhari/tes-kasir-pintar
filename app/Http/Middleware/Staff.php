<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Staff
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
        if(\Auth::user()->role == 'staff') {
            return $next($request);
        }

        return back()->with('error', 'Oops, anda tidak dapat mengaksesnya !');
    }
}
