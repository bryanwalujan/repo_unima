<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated with the 'web' guard
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai admin.');
        }

        // Check if the authenticated user has the admin role
        if (Auth::guard('web')->user()->role !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak. Hanya admin yang diizinkan.');
        }

        return $next($request);
    }
}