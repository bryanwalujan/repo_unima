<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengabdian | Repositori Dosen - Universitas Negeri Manado</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Pengabdian</h1>
            <a href="{{ route('dosen.dashboard') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('dosen.pengabdian.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        <i class="fas fa-hands-helping mr-2 text-yellow-500"></i> Pengabdian
                    </h3>
                </div>
                <div class="px-6 py-4 space-y-6">
                    @forelse ($pengabdians as $index => $pengabdian)
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Skema</label>
                                    <select name="pengabdians[{{$index}}][skema]" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="" disabled {{ old('pengabdians.' . $index . '.skema', $pengabdian->skema) ? '' : 'selected' }}>Pilih Skema</option>
                                        <option value="-" {{ old('pengabdians.' . $index . '.skema', $pengabdian->skema) == '-' ? 'selected' : '' }}>-</option>
                                        <option value="drtpm" {{ old('pengabdians.' . $index . '.skema', $pengabdian->skema) == 'drtpm' ? 'selected' : '' }}>DRTPM</option>
                                        <option value="internal" {{ old('pengabdians.' . $index . '.skema', $pengabdian->skema) == 'internal' ? 'selected' : '' }}>Pendanaan Internal</option>
                                        <option value="hibah" {{ old('pengabdians.' . $index . '.skema', $pengabdian->skema) == 'hibah' ? 'selected' : '' }}>Pendanaan Hibah</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
                                    <input type="text" name="pengabdians[{{$index}}][posisi]" value="{{ old('pengabdians.' . $index . '.posisi', $pengabdian->posisi) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Pengabdian</label>
                                    <input type="text" name="pengabdians[{{$index}}][judul_pengabdian]" value="{{ old('pengabdians.' . $index . '.judul_pengabdian', $pengabdian->judul_pengabdian) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Dana</label>
                                    <input type="text" name="pengabdians[{{$index}}][sumber_dana]" value="{{ old('pengabdians.' . $index . '.sumber_dana', $pengabdian->sumber_dana) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <input type="text" name="pengabdians[{{$index}}][status]" value="{{ old('pengabdians.' . $index . '.status', $pengabdian->status) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                                    <input type="number" name="pengabdians[{{$index}}][tahun]" value="{{ old('pengabdians.' . $index . '.tahun', $pengabdian->tahun) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Link Luaran</label>
                                    <input type="url" name="pengabdians[{{$index}}][link_luaran]" value="{{ old('pengabdians.' . $index . '.link_luaran', $pengabdian->link_luaran) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada pengabdian yang terdaftar.</p>
                    @endforelse
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('dosen.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>
</html>