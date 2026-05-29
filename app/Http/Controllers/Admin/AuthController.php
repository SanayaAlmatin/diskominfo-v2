<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Selamat datang, ' . Auth::user()->nama . '!');
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan tidak valid.',
        ])->withInput($request->only('username'));
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('admin.login')
                ->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }

        // Whitelist check: email must be pre-registered in the database
        $user = User::where('email', $googleUser->getEmail())->first();

        if (! $user) {
            return redirect()->route('admin.login')
                ->with('error', 'Akun Google Anda (' . $googleUser->getEmail() . ') tidak terdaftar. Hubungi administrator.');
        }

        // Update google_id and avatar if not set
        $user->update([
            'google_id' => $googleUser->getId(),
            'avatar'    => $googleUser->getAvatar(),
        ]);

        Auth::login($user, true);
        request()->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Selamat datang, ' . $user->nama . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah berhasil logout.');
    }
}
