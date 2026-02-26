<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Check user di database
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan'])
                        ->withInput($request->only('email'));
        }

        // Verify password
        if (!Hash::check($password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah'])
                        ->withInput($request->only('email'));
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect based on role, using intended to return to previous page if it exists
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Login berhasil! Selamat datang admin.');
        } else {
            return redirect()->intended(route('user.home'))->with('success', 'Login berhasil!');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout');
    }
}
