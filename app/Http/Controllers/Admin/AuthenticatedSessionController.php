<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the admin login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming admin authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            
            // CRITICAL: Check if the authenticated user is an admin
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            // If the user is NOT an admin, log them out immediately
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // If authentication fails or user is not an admin, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you are not an administrator.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
