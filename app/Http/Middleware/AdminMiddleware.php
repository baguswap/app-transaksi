<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Jika pengguna bukan admin, arahkan mereka ke halaman lain atau berikan respons yang sesuai
        return redirect('/login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
