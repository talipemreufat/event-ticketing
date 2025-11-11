<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle the authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // ✅ IDE uyarısı için garanti: $request Laravel LoginRequest türünde
        /** @var \App\Http\Requests\Auth\LoginRequest $request */

        // Kullanıcı doğrulaması
        $request->authenticate();

        // Yeni session oluştur
        $request->session()->regenerate();

        // Kullanıcı rolünü al
        $user = Auth::user();

        // Rol bazlı yönlendirme
        if (in_array($user->role, ['admin', 'organizer', 'attendee'])) {
            return redirect()->route('events.index');
        }

        // Fallback — tanımsız rol varsa
        return redirect('/');
    }

    /**
     * Log out the user and destroy session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        /** @var \Illuminate\Http\Request $request */
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
