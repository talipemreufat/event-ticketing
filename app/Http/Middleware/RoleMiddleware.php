<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Giriş yapılmamışsa login'e yönlendir
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Kullanıcının rolü tanımlı rollerden birinde mi?
        $userRole = Auth::user()->role ?? null;

        // Eğer rol boşsa veya listede yoksa -> yetkisiz
        if (!$userRole || !in_array($userRole, $roles)) {
            abort(403, 'Bu sayfaya erişim yetkiniz yok.');
        }

        return $next($request);
    }
}
