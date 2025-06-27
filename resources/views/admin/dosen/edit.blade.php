<!DOCTYPE html>
<html>
<head>
    <title>Edit Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Dosen</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('admin.dosen.update', $dosen->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <div class="mb-4">
                    <label class="block text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}" class="w-full p-2 border rounded" required>
                </div>
                <h3 class="text-xl font-semibold mb-4">Data Diri</h3>
                <div class="mb-4">
                    <label class="block text-gray-700">NIDN</label>
                    <input type="text" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip', $dosen->nip) }}" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">NUPTK</label>
                    <input type="text" name="nuptk" value="{{ old('nuptk', $dosen->nuptk) }}" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Foto</label>
                    @if ($dosen->foto)
                        <img src="{{ Storage::url($dosen->foto) }}" alt="Foto {{ $dosen->nama }}" class="w-32 h-32 mb-2 object-cover rounded-full">
                    @endif
                    <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg" class="mt-1 p-2 w-full border rounded">
                    <p class="text-sm text-gray-600">Biarkan kosong jika tidak ingin mengganti foto.</p>
                    @error('foto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">Penelitian</h3>
                <div id="penelitian-fields">
                    @forelse ($dosen->penelitians as $index => $penelitian)
                        <div class="penelitian-group mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Skema</label>
                                    <input type="text" name="penelitians[{{$index}}][skema]" value="{{ old('penelitians.' . $index . '.skema', $penelitian->skema) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Posisi</label>
                                    <input type="text" name="penelitians[{{$index}}][posisi]" value="{{ old('penelitians.' . $index . '.posisi', $penelitian->posisi) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Judul Penelitian</label>
                                    <input type="text" name="penelitians[{{$index}}][judul_penelitian]" value="{{ old('penelitians.' . $index . '.judul_penelitian', $penelitian->judul_penelitian) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Sumber Dana</label>
                                    <input type="text" name="penelitians[{{$index}}][sumber_dana]" value="{{ old('penelitians.' . $index . '.sumber_dana', $penelitian->sumber_dana) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Status</label>
                                    <input type="text" name="penelitians[{{$index}}][status]" value="{{ old('penelitians.' . $index . '.status', $penelitian->status) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Tahun</label>
                                    <input type="number" name="penelitians[{{$index}}][tahun]" value="{{ old('penelitians.' . $index . '.tahun', $penelitian->tahun) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Link Luaran</label>
                                    <input type="url" name="penelitians[{{$index}}][link_luaran]" value="{{ old('penelitians.' . $index . '.link_luaran', $penelitian->link_luaran) }}" class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="penelitian-group mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Skema</label>
                                    <input type="text" name="penelitians[0][skema]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Posisi</label>
                                    <input type="text" name="penelitians[0][posisi]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Judul Penelitian</label>
                                    <input type="text" name="penelitians[0][judul_penelitian]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Sumber Dana</label>
                                    <input type="text" name="penelitians[0][sumber_dana]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Status</label>
                                    <input type="text" name="penelitians[0][status]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Tahun</label>
                                    <input type="number" name="penelitians[0][tahun]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Link Luaran</label>
                                    <input type="url" name="penelitians[0][link_luaran]" class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" id="add-penelitian" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Penelitian</button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">Pengabdian</h3>
                <div id="pengabdian-fields">
                    @forelse ($dosen->pengabdians as $index => $pengabdian)
                        <div class="pengabdian-group mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Skema</label>
                                    <input type="text" name="pengabdians[{{$index}}][skema]" value="{{ old('pengabdians.' . $index . '.skema', $pengabdian->skema) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Posisi</label>
                                    <input type="text" name="pengabdians[{{$index}}][posisi]" value="{{ old('pengabdians.' . $index . '.posisi', $pengabdian->posisi) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Judul Pengabdian</label>
                                    <input type="text" name="pengabdians[{{$index}}][judul_pengabdian]" value="{{ old('pengabdians.' . $index . '.judul_pengabdian', $pengabdian->judul_pengabdian) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Sumber Dana</label>
                                    <input type="text" name="pengabdians[{{$index}}][sumber_dana]" value="{{ old('pengabdians.' . $index . '.sumber_dana', $pengabdian->sumber_dana) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Status</label>
                                    <input type="text" name="pengabdians[{{$index}}][status]" value="{{ old('pengabdians.' . $index . '.status', $pengabdian->status) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Tahun</label>
                                    <input type="number" name="pengabdians[{{$index}}][tahun]" value="{{ old('pengabdians.' . $index . '.tahun', $pengabdian->tahun) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Link Luaran</label>
                                    <input type="url" name="pengabdians[{{$index}}][link_luaran]" value="{{ old('pengabdians.' . $index . '.link_luaran', $pengabdian->link_luaran) }}" class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="pengabdian-group mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Skema</label>
                                    <input type="text" name="pengabdians[0][skema]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Posisi</label>
                                    <input type="text" name="pengabdians[0][posisi]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Judul Pengabdian</label>
                                    <input type="text" name="pengabdians[0][judul_pengabdian]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Sumber Dana</label>
                                    <input type="text" name="pengabdians[0][sumber_dana]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Status</label>
                                    <input type="text" name="pengabdians[0][status]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Tahun</label>
                                    <input type="number" name="pengabdians[0][tahun]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Link Luaran</label>
                                    <input type="url" name="pengabdians[0][link_luaran]" class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" id="add-pengabdian" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Pengabdian</button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">HAKI</h3>
                <div id="haki-fields">
                    @forelse ($dosen->hakis as $index => $haki)
                        <div class="haki-group mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Judul HAKI</label>
                                    <input type="text" name="hakis[{{$index}}][judul_haki]" value="{{ old('hakis.' . $index . '.judul_haki', $haki->judul_haki) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Expired</label>
                                    <input type="date" name="hakis[{{$index}}][expired]" value="{{ old('hakis.' . $index . '.expired', $haki->expired) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Link</label>
                                    <input type="url" name="hakis[{{$index}}][link]" value="{{ old('hakis.' . $index . '.link', $haki->link) }}" class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="haki-group mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Judul HAKI</label>
                                    <input type="text" name="hakis[0][judul_haki]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Expired</label>
                                    <input type="date" name="hakis[0][expired]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Link</label>
                                    <input type="url" name="hakis[0][link]" class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" id="add-haki" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah HAKI</button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">Paten</h3>
                <div id="paten-fields">
                    @forelse ($dosen->patens as $index => $paten)
                        <div class="paten-group mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Judul Paten</label>
                                    <input type="text" name="patens[{{$index}}][judul_paten]" value="{{ old('patens.' . $index . '.judul_paten', $paten->judul_paten) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Jenis Paten</label>
                                    <input type="text" name="patens[{{$index}}][jenis_paten]" value="{{ old('patens.' . $index . '.jenis_paten', $paten->jenis_paten) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Expired</label>
                                    <input type="date" name="patens[{{$index}}][expired]" value="{{ old('patens.' . $index . '.expired', $paten->expired) }}" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Link</label>
                                    <input type="url" name="patens[{{$index}}][link]" value="{{ old('patens.' . $index . '.link', $paten->link) }}" class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="paten-group mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700">Judul Paten</label>
                                    <input type="text" name="patens[0][judul_paten]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Jenis Paten</label>
                                    <input type="text" name="patens[0][jenis_paten]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Expired</label>
                                    <input type="date" name="patens[0][expired]" class="w-full p-2 border rounded">
                                </div>
                                <div>
                                    <label class="block text-gray-700">Link</label>
                                    <input type="url" name="patens[0][link]" class="w-full p-2 border rounded">
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
                <button type="button" id="add-paten" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Paten</button>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update</button>
            <a href="{{ route('admin.dosen.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-2">Batal</a>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            let penelitianCount = {{ $dosen->penelitians->count() }};
            $('#add-penelitian').click(function () {
                $('#penelitian-fields').append(`
                    <div class="penelitian-group mb-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700">Skema</label>
                                <input type="text" name="penelitians[${penelitianCount}][skema]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Posisi</label>
                                <input type="text" name="penelitians[${penelitianCount}][posisi]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Judul Penelitian</label>
                                <input type="text" name="penelitians[${penelitianCount}][judul_penelitian]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Sumber Dana</label>
                                <input type="text" name="penelitians[${penelitianCount}][sumber_dana]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Status</label>
                                <input type="text" name="penelitians[${penelitianCount}][status]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Tahun</label>
                                <input type="number" name="penelitians[${penelitianCount}][tahun]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Link Luaran</label>
                                <input type="url" name="penelitians[${penelitianCount}][link_luaran]" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                `);
                penelitianCount++;
            });

            let pengabdianCount = {{ $dosen->pengabdians->count() }};
            $('#add-pengabdian').click(function () {
                $('#pengabdian-fields').append(`
                    <div class="pengabdian-group mb-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700">Skema</label>
                                <input type="text" name="pengabdians[${pengabdianCount}][skema]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Posisi</label>
                                <input type="text" name="pengabdians[${pengabdianCount}][posisi]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Judul Pengabdian</label>
                                <input type="text" name="pengabdians[${pengabdianCount}][judul_pengabdian]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Sumber Dana</label>
                                <input type="text" name="pengabdians[${pengabdianCount}][sumber_dana]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Status</label>
                                <input type="text" name="pengabdians[${pengabdianCount}][status]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Tahun</label>
                                <input type="number" name="pengabdians[${pengabdianCount}][tahun]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Link Luaran</label>
                                <input type="url" name="pengabdians[${pengabdianCount}][link_luaran]" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                `);
                pengabdianCount++;
            });

            let hakiCount = {{ $dosen->hakis->count() }};
            $('#add-haki').click(function () {
                $('#haki-fields').append(`
                    <div class="haki-group mb-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700">Judul HAKI</label>
                                <input type="text" name="hakis[${hakiCount}][judul_haki]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Expired</label>
                                <input type="date" name="hakis[${hakiCount}][expired]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Link</label>
                                <input type="url" name="hakis[${hakiCount}][link]" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                `);
                hakiCount++;
            });