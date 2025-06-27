<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Haki;
use App\Models\Paten;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DosenImport;

class DosenController extends Controller
{

    public function index()
    {
        $dosens = Dosen::with(['penelitians', 'pengabdians', 'hakis', 'patens'])->get();
        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn',
            'nip' => 'nullable',
            'nuptk' => 'nullable',
            'nama' => 'required',
        ]);

        $dosen = Dosen::create($request->only(['nidn', 'nip', 'nuptk', 'nama']));

        // Simpan data portofolio jika ada
        if ($request->has('penelitians')) {
            foreach ($request->penelitians as $penelitian) {
                Penelitian::create(array_merge($penelitian, ['dosen_id' => $dosen->id]));
            }
        }
        if ($request->has('pengabdians')) {
            foreach ($request->pengabdians as $pengabdian) {
                Pengabdian::create(array_merge($pengabdian, ['dosen_id' => $dosen->id]));
            }
        }
        if ($request->has('hakis')) {
            foreach ($request->hakis as $haki) {
                Haki::create(array_merge($haki, ['dosen_id' => $dosen->id]));
            }
        }
        if ($request->has('patens')) {
            foreach ($request->patens as $paten) {
                Paten::create(array_merge($paten, ['dosen_id' => $dosen->id]));
            }
        }

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new DosenImport, $request->file('file'));
        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diimpor.');
    }
}