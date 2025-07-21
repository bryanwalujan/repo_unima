<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // Login Form untuk Admin
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login Tradisional untuk Admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user instanceof \App\Models\User && $user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Hanya admin yang dapat login melalui metode ini.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Redirect ke Google untuk Login Dosen
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->scopes(['email', 'profile', 'openid'])->redirect();
    }

    // Callback dari Google untuk Login Dosen
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $email = $googleUser->getEmail();

            // Verifikasi domain unima.ac.id untuk dosen
            if (!str_ends_with($email, '@unima.ac.id')) {
                return redirect('/login')->with('error', 'Hanya akun dengan domain unima.ac.id yang diizinkan untuk dosen.');
            }

            // Cari atau buat dosen berdasarkan email
            $dosen = Dosen::firstOrCreate(
                ['email' => $email],
                [
                    'nama' => $googleUser->getName(),
                    'nidn' => '', // Isi default, bisa diupdate nanti
                    'nip' => '',
                    'nuptk' => '',
                ]
            );

            // Login menggunakan guard 'dosen'
            Auth::guard('dosen')->login($dosen);

            return redirect()->route('dosen.dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
        }
    }

    // Logout untuk Semua Pengguna
    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Logout admin
        Auth::guard('dosen')->logout(); // Logout dosen
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}