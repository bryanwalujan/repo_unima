<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <div class="container mx-auto p-6 flex-grow flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Pencarian Dosen</h1>
        <form action="{{ route('public.search') }}" method="POST" class="w-full max-w-2xl">
            @csrf
            <div class="mb-6">
                <input type="text" name="query" value="{{ old('query', $query ?? '') }}" placeholder="Masukkan Nama atau NIDN Dosen" class="w-full p-4 text-lg border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('query')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site') }}"></div>
                @error('g-recaptcha-response')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white p-4 rounded-lg hover:bg-blue-600 text-lg">Cari Dosen</button>
        </form>

        @if (isset($dosens) && $dosens->count() > 0)
            @foreach ($dosens as $dosen)
                <div class="mt-8 w-full max-w-4xl">
                    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                        <div class="flex items-center space-x-6">
                            <div class="w-32 h-32 bg-gray-300 rounded-full overflow-hidden flex-shrink-0">
                                <!-- Tampilkan foto dari storage jika ada, jika tidak gunakan placeholder -->
                                <img src="{{ $dosen->foto ? Storage::url($dosen->foto) : 'https://via.placeholder.com/128' }}" alt="Foto Dosen {{ $dosen->nama }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold">{{ $dosen->nama }}</h2>
                                <p class="text-gray-600"><strong>NIDN:</strong> {{ $dosen->nidn ?? '-' }}</p>
                                <p class="text-gray-600"><strong>NIP:</strong> {{ $dosen->nip ?? '-' }}</p>
                                <p class="text-gray-600"><strong>NUPTK:</strong> {{ $dosen->nuptk ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="tabs">
                            <ul class="flex border-b mb-4">
                                <li class="mr-1">
                                    <a class="tab-link bg-gray-100 px-4 py-2 inline-block" data-tab="penelitian-{{ $dosen->id }}">Penelitian</a>
                                </li>
                                <li class="mr-1">
                                    <a class="tab-link px-4 py-2 inline-block" data-tab="pengabdian-{{ $dosen->id }}">Pengabdian</a>
                                </li>
                                <li class="mr-1">
                                    <a class="tab-link px-4 py-2 inline-block" data-tab="haki-{{ $dosen->id }}">HAKI</a>
                                </li>
                                <li class="mr-1">
                                    <a class="tab-link px-4 py-2 inline-block" data-tab="paten-{{ $dosen->id }}">Paten</a>
                                </li>
                            </ul>

                            <div id="penelitian-{{ $dosen->id }}" class="tab-content">
                                <table class="w-full border">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border px-4 py-2">Judul Penelitian</th>
                                            <th class="border px-4 py-2">Skema</th>
                                            <th class="border px-4 py-2">Tahun</th>
                                            <th class="border px-4 py-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dosen->penelitians as $penelitian)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $penelitian->judul_penelitian }}</td>
                                                <td class="border px-4 py-2">{{ $penelitian->skema }}</td>
                                                <td class="border px-4 py-2">{{ $penelitian->tahun }}</td>
                                                <td class="border px-4 py-2">{{ $penelitian->status }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="border px-4 py-2 text-center">Tidak ada data penelitian.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div id="pengabdian-{{ $dosen->id }}" class="tab-content hidden">
                                <table class="w-full border">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border px-4 py-2">Judul Pengabdian</th>
                                            <th class="border px-4 py-2">Skema</th>
                                            <th class="border px-4 py-2">Tahun</th>
                                            <th class="border px-4 py-2">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dosen->pengabdians as $pengabdian)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $pengabdian->judul_pengabdian }}</td>
                                                <td class="border px-4 py-2">{{ $pengabdian->skema }}</td>
                                                <td class="border px-4 py-2">{{ $pengabdian->tahun }}</td>
                                                <td class="border px-4 py-2">{{ $pengabdian->status }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="border px-4 py-2 text-center">Tidak ada data pengabdian.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div id="haki-{{ $dosen->id }}" class="tab-content hidden">
                                <table class="w-full border">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border px-4 py-2">Judul HAKI</th>
                                            <th class="border px-4 py-2">Expired</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dosen->hakis as $haki)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $haki->judul_haki }}</td>
                                                <td class="border px-4 py-2">{{ $haki->expired ? \Carbon\Carbon::parse($haki->expired)->format('Y-m-d') : '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="border px-4 py-2 text-center">Tidak ada data HAKI.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div id="paten-{{ $dosen->id }}" class="tab-content hidden">
                                <table class="w-full border">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border px-4 py-2">Judul Paten</th>
                                            <th class="border px-4 py-2">Jenis Paten</th>
                                            <th class="border px-4 py-2">Expired</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dosen->patens as $paten)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $paten->judul_paten }}</td>
                                                <td class="border px-4 py-2">{{ $paten->jenis_paten }}</td>
                                                <td class="border px-4 py-2">{{ $paten->expired ? \Carbon\Carbon::parse($paten->expired)->format('Y-m-d') : '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="border px-4 py-2 text-center">Tidak ada data paten.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @elseif (isset($dosens))
            <div class="mt-8 w-full max-w-4xl">
                <p class="text-lg text-gray-600">Tidak ada dosen yang ditemukan untuk pencarian "{{ $query }}".</p>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('.tab-link');
            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tabId = this.getAttribute('data-tab');
                    const tabContents = document.querySelectorAll('.tab-content');
                    tabContents.forEach(content => content.classList.add('hidden'));
                    document.getElementById(tabId).classList.remove('hidden');
                    tabLinks.forEach(l => l.classList.remove('bg-gray-100'));
                    this.classList.add('bg-gray-100');
                });
            });
            // Aktifkan tab pertama secara default
            if (tabLinks.length > 0) {
                tabLinks[0].click();
            }
        });
    </script>
</body>
</html>