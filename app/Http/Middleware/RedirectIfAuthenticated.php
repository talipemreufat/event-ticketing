<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Kullanıcı zaten giriş yapmışsa yönlendirileceği sayfa.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (auth()->guard($guard)->check()) {
                // Giriş yapılmışsa dashboard’a yönlendir
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
