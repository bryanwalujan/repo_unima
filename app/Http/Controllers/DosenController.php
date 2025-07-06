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
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
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
            'email' => 'required|email|unique:dosens,email,' . $dosen->id,
            'nidn' => 'required|string|max:20|unique:dosens,nidn,' . $dosen->id,
            'nip' => 'nullable|string|max:20',
            'nuptk' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
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

        $data = $request->only(['nama', 'email', 'nidn', 'nip', 'nuptk']);

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

    public function editProfile()
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }
        return view('dosen.edit', compact('dosen'));
    }

    public function updateProfile(Request $request)
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|max:20|unique:dosens,nidn,' . $dosen->id,
            'nip' => 'nullable|string|max:20',
            'nuptk' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
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
        return redirect()->route('dosen.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

    public function editPenelitian()
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }
        $penelitians = $dosen->penelitians;
        return view('dosen.edit-penelitian', compact('dosen', 'penelitians'));
    }

    public function updatePenelitian(Request $request)
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'penelitians.*.skema' => 'nullable|string',
            'penelitians.*.posisi' => 'nullable|string',
            'penelitians.*.judul_penelitian' => 'nullable|string',
            'penelitians.*.sumber_dana' => 'nullable|string',
            'penelitians.*.status' => 'nullable|string',
            'penelitians.*.tahun' => 'nullable|integer',
            'penelitians.*.link_luaran' => 'nullable|url',
        ]);

        $dosen->penelitians()->delete();
        if ($request->has('penelitians')) {
            foreach ($request->penelitians as $penelitian) {
                if ($penelitian['judul_penelitian']) {
                    $dosen->penelitians()->create($penelitian);
                }
            }
        }

        return redirect()->route('dosen.dashboard')->with('success', 'Penelitian berhasil diperbarui.');
    }

    public function editPengabdian()
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }
        $pengabdians = $dosen->pengabdians;
        return view('dosen.edit-pengabdian', compact('dosen', 'pengabdians'));
    }

    public function updatePengabdian(Request $request)
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'pengabdians.*.skema' => 'nullable|string',
            'pengabdians.*.posisi' => 'nullable|string',
            'pengabdians.*.judul_pengabdian' => 'nullable|string',
            'pengabdians.*.sumber_dana' => 'nullable|string',
            'pengabdians.*.status' => 'nullable|string',
            'pengabdians.*.tahun' => 'nullable|integer',
            'pengabdians.*.link_luaran' => 'nullable|url',
        ]);

        $dosen->pengabdians()->delete();
        if ($request->has('pengabdians')) {
            foreach ($request->pengabdians as $pengabdian) {
                if ($pengabdian['judul_pengabdian']) {
                    $dosen->pengabdians()->create($pengabdian);
                }
            }
        }

        return redirect()->route('dosen.dashboard')->with('success', 'Pengabdian berhasil diperbarui.');
    }

    public function editHaki()
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }
        $hakis = $dosen->hakis;
        return view('dosen.edit-haki', compact('dosen', 'hakis'));
    }

    public function updateHaki(Request $request)
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'hakis.*.judul_haki' => 'nullable|string',
            'hakis.*.expired' => 'nullable|date',
            'hakis.*.link' => 'nullable|url',
        ]);

        $dosen->hakis()->delete();
        if ($request->has('hakis')) {
            foreach ($request->hakis as $haki) {
                if ($haki['judul_haki']) {
                    $dosen->hakis()->create($haki);
                }
            }
        }

        return redirect()->route('dosen.dashboard')->with('success', 'HAKI berhasil diperbarui.');
    }

    public function editPaten()
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }
        $patens = $dosen->patens;
        return view('dosen.edit-paten', compact('dosen', 'patens'));
    }

    public function updatePaten(Request $request)
    {
        $dosen = Auth::guard('dosen')->user();
        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'patens.*.judul_paten' => 'nullable|string',
            'patens.*.jenis_paten' => 'nullable|string',
            'patens.*.expired' => 'nullable|date',
            'patens.*.link' => 'nullable|url',
        ]);

        $dosen->patens()->delete();
        if ($request->has('patens')) {
            foreach ($request->patens as $paten) {
                if ($paten['judul_paten']) {
                    $dosen->patens()->create($paten);
                }
            }
        }

        return redirect()->route('dosen.dashboard')->with('success', 'Paten berhasil diperbarui.');
    }
}