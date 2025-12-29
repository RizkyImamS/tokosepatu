<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    public function handle(Request $request, Closure $next)
    {
        // Jika user belum login (Auth::check() mengembalikan false)
        if (!Auth::check()) {
            // Arahkan ke halaman login dengan pesan peringatan
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu!');
        }

        // Jika sudah login, izinkan melanjutkan ke halaman yang diminta
        return $next($request);
    }
}
