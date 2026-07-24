<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Jika belum login, atau role-nya tidak cocok dengan rute yang dituju
        if (!auth()->check() || auth()->user()->role !== $role) {
            // Tolak dengan halaman 403 (Forbidden)
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
