<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        activity()
            ->withProperties(['ip' => request()->ip()])
            ->log('Someone Visited to login Page');

        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'session' => request()->session()->getId(),
                'ip' => request()->ip(),
                'action_time' => now(),
            ])
            ->log(Auth::user()->name . 'Logged in from ' . request()->ip());
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'ip' => request()->ip(),
                'old_sesion' => request()->session()->getId(),
                'action_time' => now(),
            ])
            ->log(Auth::user()->name . 'Logged out from ' . request()->ip());

        Auth::guard('web')->logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
