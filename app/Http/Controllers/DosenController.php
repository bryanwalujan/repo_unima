<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Imports\DosenImport;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Haki;
use App\Models\Paten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DosenController extends Controller
{
    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:20|unique:dosens,nidn',
            'nip' => 'nullable|string|max:20',
            'nuptk' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'penelitians.*.skema' => 'nullable|string',
            'penelitians.*.posisi' => 'nullable|string',
            'penelitians.*.judul_penelitian' => 'nullable|string',
            'penelitians.*.sumber_dana' => 'nullable|string',
            'penelitians.*.status' => 'nullable|string',
            'penelitians.*.tahun' => 'nullable|integer',
            'penelitians.*.link_luaran' => 'nullable|url',
            'pengabdians.*.skema' => 'nullable|string',
            'pengabdians.*.posisi' => 'nullable|string',
            'pengabdians.*.judul_pengabdian' => 'nullable|string',
            'pengabdians.*.sumber_dana' => 'nullable|string',
            'pengabdians.*.status' => 'nullable|string',
            'pengabdians.*.tahun' => 'nullable|integer',
            'pengabdians.*.link_luaran' => 'nullable|url',
            'hakis.*.judul_haki' => 'nullable|string',
            'hakis.*.expired' => 'nullable|date',
            'hakis.*.link' => 'nullable|url',
            'patens.*.judul_paten' => 'nullable|string',
            'patens.*.jenis_paten' => 'nullable|string',
            'patens.*.expired' => 'nullable|date',
            'patens.*.link' => 'nullable|url',
        ]);

        $data = $request->only(['nama', 'nidn', 'nip', 'nuptk']);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('dosen', 'public');
            $data['foto'] = $path;
        }

        $dosen = Dosen::create($data);

        if ($request->has('penelitians')) {
            foreach ($request->penelitians as $penelitian) {
                if ($penelitian['judul_penelitian']) {
                    $dosen->penelitians()->create($penelitian);
                }
            }
        }

        if ($request->has('pengabdians')) {
            foreach ($request->pengabdians as $pengabdian) {
                if ($pengabdian['judul_pengabdian']) {
                    $dosen->pengabdians()->create($pengabdian);
                }
            }
        }

        if ($request->has('hakis')) {
            foreach ($request->hakis as $haki) {
                if ($haki['judul_haki']) {
                    $dosen->hakis()->create($haki);
                }
            }
        }

        if ($request->has('patens')) {
            foreach ($request->patens as $paten) {
                if ($paten['judul_paten']) {
                    $dosen->patens()->create($paten);
                }
            }
        }

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function index()
    {
        $dosens = Dosen::with(['penelitians', 'pengabdians', 'hakis', 'patens'])->get();
        return view('admin.dosen.index', compact('dosens'));
    }

    public function show($id)
    {
        $dosen = Dosen::with(['penelitians', 'pengabdians', 'hakis', 'patens'])->findOrFail($id);
        return view('admin.dosen.show', compact('dosen'));
    }

    public function edit($id)
    {
        $dosen = Dosen::with(['penelitians', 'pengabdians', 'hakis', 'patens'])->findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:20|unique:dosens,nidn,' . $dosen->id,
            'nip' => 'nullable|string|max:16',
            'nuptk' => 'nullable|string|max:16',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'penelitians.*.skema' => 'nullable|string',
            'penelitians.*.posisi' => 'nullable|string',
            'penelitians.*.judul_penelitian' => 'nullable|string',
            'penelitians.*.sumber_dana' => 'nullable|string',
            'penelitians.*.status' => 'nullable|string',
            'penelitians.*.tahun' => 'nullable|integer',
            'penelitians.*.link_luaran' => 'nullable|url',
            'pengabdians.*.skema' => 'nullable|string',
            'pengabdians.*.posisi' => 'nullable|string',
            'pengabdians.*.judul_pengabdian' => 'nullable|string',
            'pengabdians.*.sumber_dana' => 'nullable|string',
            'pengabdians.*.status' => 'nullable|string',
            'pengabdians.*.tahun' => 'nullable|integer',
            'pengabdians.*.link_luaran' => 'nullable|url',
            'hakis.*.judul_haki' => 'nullable|string',
            'hakis.*.expired' => 'nullable|date',
            'hakis.*.link' => 'nullable|url',
            'patens.*.judul_paten' => 'nullable|string',
            'patens.*.jenis_paten' => 'nullable|string',
            'patens.*.expired' => 'nullable|date',
            'patens.*.link' => 'nullable|url',
        ]);

        $data = $request->only(['nama', 'nidn', 'nip', 'nuptk']);

        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $path = $request->file('foto')->store('dosen', 'public');
            $data['foto'] = $path;
        }

        $dosen->update($data);

        $dosen->penelitians()->delete();
        if ($request->has('penelitians')) {
            foreach ($request->penelitians as $penelitian) {
                if ($penelitian['judul_penelitian']) {
                    $dosen->penelitians()->create($penelitian);
                }
            }
        }

        $dosen->pengabdians()->delete();
        if ($request->has('pengabdians')) {
            foreach ($request->pengabdians as $pengabdian) {
                if ($pengabdian['judul_pengabdian']) {
                    $dosen->pengabdians()->create($pengabdian);
                }
            }
        }

        $dosen->hakis()->delete();
        if ($request->has('hakis')) {
            foreach ($request->hakis as $haki) {
                if ($haki['judul_haki']) {
                    $dosen->hakis()->create($haki);
                }
            }
        }

        $dosen->patens()->delete();
        if ($request->has('patens')) {
            foreach ($request->patens as $paten) {
                if ($paten['judul_paten']) {
                    $dosen->patens()->create($paten);
                }
            }
        }

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);

        if ($dosen->foto) {
            Storage::disk('public')->delete($dosen->foto);
        }

        $dosen->penelitians()->delete();
        $dosen->pengabdians()->delete();
        $dosen->hakis()->delete();
        $dosen->patens()->delete();
        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            Excel::import(new DosenImport, $request->file('file'));
            return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}