<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.index');
    }

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'g-recaptcha-response' => 'required',
            'query' => 'required|string|min:2',
        ]);

        // Verifikasi reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $recaptchaResult = $response->json();

        if (!$recaptchaResult['success']) {
            return back()->withErrors(['g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.']);
        }

        // Cari dosen berdasarkan nama atau NIDN
        $query = $request->input('query');
        $dosens = Dosen::where('nama', 'like', '%' . $query . '%')
            ->orWhere('nidn', 'like', '%' . $query . '%')
            ->with(['penelitians', 'pengabdians', 'hakis', 'patens'])
            ->get();

        return view('public.index', compact('dosens', 'query'));
    }
}