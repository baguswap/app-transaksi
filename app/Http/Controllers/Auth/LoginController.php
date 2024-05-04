<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, arahkan pengguna sesuai peran
            return $this->redirectBasedOnRole(Auth::user()->role);
        }

        // Jika autentikasi gagal, arahkan kembali dengan pesan kesalahan
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }

    // Metode untuk mengarahkan pengguna sesuai peran
    protected function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;
            case 'verifikator':
                return redirect()->route('verifikator.dashboard');
                break;
            case 'user':
                return redirect()->route('user.dashboard');
                break;
            default:
                // Jika peran tidak valid, arahkan ke halaman login dengan pesan kesalahan
                return redirect()->route('login')->withErrors(['email' => 'Invalid role']);
        }
    }
}
