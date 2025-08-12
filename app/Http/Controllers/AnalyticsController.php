<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Haki;
use App\Models\Paten;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Total counts
        $totalDosens = Dosen::count();
        $totalPenelitians = Penelitian::count();
        $totalPengabdians = Pengabdian::count();
        $totalHakis = Haki::count();
        $totalPatens = Paten::count();

        // Penelitian per tahun
        $penelitianPerTahun = Penelitian::select('tahun', DB::raw('count(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun')
            ->toArray();

        // Distribusi skema penelitian
        $skemaPenelitian = Penelitian::select('skema', DB::raw('count(*) as total'))
            ->groupBy('skema')
            ->pluck('total', 'skema')
            ->toArray();

        // Top 5 dosen berdasarkan penelitian
        $topDosen = Dosen::withCount('penelitians')
            ->orderBy('penelitians_count', 'desc')
            ->take(5)
            ->get(['id', 'nama', 'penelitians_count'])
            ->map(function ($dosen) {
                return [
                    'nama' => $dosen->nama,
                    'total_penelitian' => $dosen->penelitians_count,
                ];
            })->toArray();

        // Pengabdian per tahun
        $pengabdianPerTahun = Pengabdian::select('tahun', DB::raw('count(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun')
            ->toArray();

        // Distribusi skema pengabdian
        $skemaPengabdian = Pengabdian::select('skema', DB::raw('count(*) as total'))
            ->groupBy('skema')
            ->pluck('total', 'skema')
            ->toArray();

        // Top 5 dosen berdasarkan pengabdian
        $topDosenPengabdian = Dosen::withCount('pengabdians')
            ->orderBy('pengabdians_count', 'desc')
            ->take(5)
            ->get(['id', 'nama', 'pengabdians_count'])
            ->map(function ($dosen) {
                return [
                    'nama' => $dosen->nama,
                    'total_pengabdian' => $dosen->pengabdians_count,
                ];
            })->toArray();

        // HAKI per tahun
        $hakiPerTahun = Haki::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('count(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun')
            ->toArray();

        // Distribusi status HAKI (Aktif vs Expired)
        $statusHaki = Haki::select(DB::raw('IF(expired < NOW(), "Expired", "Aktif") as status'), DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Top 5 dosen berdasarkan HAKI
        $topDosenHaki = Dosen::withCount('hakis')
            ->orderBy('hakis_count', 'desc')
            ->take(5)
            ->get(['id', 'nama', 'hakis_count'])
            ->map(function ($dosen) {
                return [
                    'nama' => $dosen->nama,
                    'total_haki' => $dosen->hakis_count,
                ];
            })->toArray();

        // Paten per tahun
        $patenPerTahun = Paten::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('count(*) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('total', 'tahun')
            ->toArray();

        // Distribusi jenis paten
        $jenisPaten = Paten::select('jenis_paten', DB::raw('count(*) as total'))
            ->groupBy('jenis_paten')
            ->pluck('total', 'jenis_paten')
            ->toArray();

        // Top 5 dosen berdasarkan paten
        $topDosenPaten = Dosen::withCount('patens')
            ->orderBy('patens_count', 'desc')
            ->take(5)
            ->get(['id', 'nama', 'patens_count'])
            ->map(function ($dosen) {
                return [
                    'nama' => $dosen->nama,
                    'total_paten' => $dosen->patens_count,
                ];
            })->toArray();

        return view('admin.analytics.index', compact(
            'totalDosens',
            'totalPenelitians',
            'totalPengabdians',
            'totalHakis',
            'totalPatens',
            'penelitianPerTahun',
            'skemaPenelitian',
            'topDosen',
            'pengabdianPerTahun',
            'skemaPengabdian',
            'topDosenPengabdian',
            'hakiPerTahun',
            'statusHaki',
            'topDosenHaki',
            'patenPerTahun',
            'jenisPaten',
            'topDosenPaten'
        ));
    }
}