<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    public function create2()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $mahasiswa = Mahasiswa::where('npm', $request->login)->first();

        $user = User::where('id', $mahasiswa->user_id)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => 'Username / Email dan Password Tidak Cocok'
            ]);
        }

        Auth::login($user, $request->boolean('remember'));
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $role = $request->role;

        if ($role === 'Admin') {
            $credentials = [
                'nip' => $request->login,
                'password' => $request->password,
                'role' => $request->role,
            ];
        }
        else if ($role === 'Staf') {
            $credentials = [
                'nik' => $request->login,
                'password' => $request->password,
                'role' => $request->role,
            ];
        }
        else if ($role === 'Ketua') {
            $credentials = [
                'nip' => $request->login,
                'password' => $request->password,
                'role' => $request->role,
            ];
        }
        else if ($role === 'Mahasiswa') {
            $credentials = [
                'npm' => $request->login,
                'password' => $request->password,
                'role' => $request->role,
            ];
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Login Gagal.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
