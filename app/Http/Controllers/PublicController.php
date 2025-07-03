<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Haki;
use App\Models\Paten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicController extends Controller
{
    public function index()
    {
        $totalDosens = Dosen::count();
        $totalPenelitians = Penelitian::count();
        $totalPengabdians = Pengabdian::count();
        $totalHakis = Haki::count();
        $totalPatens = Paten::count();
        return view('public.index', compact('totalDosens', 'totalPenelitians', 'totalPengabdians', 'totalHakis', 'totalPatens'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required',
            'query' => 'required|string|min:2',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $recaptchaResult = $response->json();

        if (!$recaptchaResult['success']) {
            return back()->withErrors(['g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.']);
        }

        $query = $request->input('query');
        $dosens = Dosen::where('nama', 'like', '%' . $query . '%')
            ->orWhere('nidn', 'like', '%' . $query . '%')
            ->with(['penelitians', 'pengabdians', 'hakis', 'patens'])
            ->get();

        $skema = $request->input('skema', 'all');

        return view('public.index', compact('dosens', 'query', 'skema'));
    }

    public function category($category)
    {
        $categoryData = [];
        $categoryTitle = '';
        $skema = request()->input('skema', 'all');

        $totalDosens = Dosen::count();
        $totalPenelitians = Penelitian::count();
        $totalPengabdians = Pengabdian::count();
        $totalHakis = Haki::count();
        $totalPatens = Paten::count();

        switch (strtolower($category)) {
            case 'dosens':
                $categoryData = Dosen::with(['penelitians', 'pengabdians', 'hakis', 'patens'])->get();
                $categoryTitle = 'Daftar Dosen';
                break;
            case 'penelitians':
                $categoryData = Penelitian::with('dosen')
                    ->when($skema !== 'all', function ($query) use ($skema) {
                        return $query->where('skema', $skema);
                    })
                    ->get();
                $categoryTitle = 'Daftar Penelitian';
                break;
            case 'pengabdians':
                $categoryData = Pengabdian::with('dosen')
                    ->when($skema !== 'all', function ($query) use ($skema) {
                        return $query->where('skema', $skema);
                    })
                    ->get();
                $categoryTitle = 'Daftar Pengabdian';
                break;
            case 'hakis':
                $categoryData = Haki::with('dosen')->get();
                $categoryTitle = 'Daftar HAKI';
                break;
            case 'patens':
                $categoryData = Paten::with('dosen')->get();
                $categoryTitle = 'Daftar Paten';
                break;
            default:
                return redirect()->route('public.index')->with('error', 'Kategori tidak valid.');
        }

        return view('public.index', compact('categoryData', 'category', 'categoryTitle', 'totalDosens', 'totalPenelitians', 'totalPengabdians', 'totalHakis', 'totalPatens', 'skema'));
    }
}