<?php

namespace App\Http\Middleware;

use Closure;

class VerifikatorMiddleware
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
        if (auth()->check() && auth()->user()->role === 'verifikator') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
