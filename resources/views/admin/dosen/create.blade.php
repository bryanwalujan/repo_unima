<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Tambah Dosen</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('admin.dosen.store') }}">
            @csrf
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">Data Diri</h3>
                <div class="mb-4">
                    <label class="block text-gray-700">NIDN</label>
                    <input type="text" name="nidn" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">NIP</label>
                    <input type="text" name="nip" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">NUPTK</label>
                    <input type="text" name="nuptk" class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Nama</label>
                    <input type="text" name="nama" class="w-full p-2 border rounded" required>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">Penelitian</h3>
                <div id="penelitian-fields">
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
                </div>
                <button type="button" id="add-penelitian" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Penelitian</button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">Pengabdian</h3>
                <div id="pengabdian-fields">
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
                </div>
                <button type="button" id="add-pengabdian" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Pengabdian</button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">HAKI</h3>
                <div id="haki-fields">
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
                </div>
                <button type="button" id="add-haki" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah HAKI</button>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-4">Paten</h3>
                <div id="paten-fields">
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
                </div>
                <button type="button" id="add-paten" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Paten</button>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            let penelitianCount = 1;
            $('#add-penelitian').click(function() {
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

            let pengabdianCount = 1;
            $('#add-pengabdian').click(function() {
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

            let hakiCount = 1;
            $('#add-haki').click(function() {
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

            let patenCount = 1;
            $('#add-paten').click(function() {
                $('#paten-fields').append(`
                    <div class="paten-group mb-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700">Judul Paten</label>
                                <input type="text" name="patens[${patenCount}][judul_paten]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Jenis Paten</label>
                                <input type="text" name="patens[${patenCount}][jenis_paten]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Expired</label>
                                <input type="date" name="patens[${patenCount}][expired]" class="w-full p-2 border rounded">
                            </div>
                            <div>
                                <label class="block text-gray-700">Link</label>
                                <input type="url" name="patens[${patenCount}][link]" class="w-full p-2 border rounded">
                            </div>
                        </div>
                    </div>
                `);
                patenCount++;
            });
        });
    </script>
</body>
</html>