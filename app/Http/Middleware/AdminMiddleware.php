<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah login dan memiliki role admin
        if (Auth::check() && Auth::user() instanceof \App\Models\User && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        // Logout jika bukan admin dan redirect ke halaman login
        Auth::logout();
        return redirect()->route('login')->withErrors(['access' => 'Akses ditolak. Hanya admin yang diizinkan.']);
    }
}