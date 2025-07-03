<!DOCTYPE html>
<html>
<head>
    <title>Detail Dosen - {{ $dosen->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card-shadow { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); }
        .status-badge {
            @apply px-2 py-1 rounded-full text-xs font-medium;
        }
        .status-selesai { @apply bg-green-100 text-green-800; }
        .status-berjalan { @apply bg-yellow-100 text-yellow-800; }
        .status-diajukan { @apply bg-blue-100 text-blue-800; }
        .action-btn { @apply transition-all duration-200 hover:opacity-80; }
        .table-row:hover { @apply bg-gray-50; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-user-tie text-green-600 mr-2"></i> Detail Dosen: {{ $dosen->nama }}
                </h1>
                <p class="text-gray-600 mt-1">Fakultas Teknik Informatika UNIMA</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fas fa-edit"></i> Edit Dosen
                </a>
                <a href="{{ route('admin.dosen.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <!-- Dosen Info -->
            <div class="flex flex-col md:flex-row items-center gap-6 mb-6">
                <div class="flex-shrink-0 h-24 w-24">
                    @if ($dosen->foto)
                        <img src="{{ Storage::url($dosen->foto) }}" alt="{{ $dosen->nama }}" class="h-24 w-24 rounded-full object-cover border">
                    @else
                        <div class="bg-gray-200 border-2 border-dashed rounded-full w-24 h-24 flex items-center justify-center text-gray-500">
                            <i class="fas fa-user text-2xl"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $dosen->nama }}</h2>
                    <p class="text-gray-600">NIDN: {{ $dosen->nidn }}</p>
                    @if ($dosen->nip)
                        <p class="text-gray-600">NIP: {{ $dosen->nip }}</p>
                    @endif
                    @if ($dosen->nuptk)
                        <p class="text-gray-600">NUPTK: {{ $dosen->nuptk }}</p>
                    @endif
                </div>
            </div>

            <!-- Portfolio Tabs -->
            <div class="border-b">
                <ul class="flex flex-wrap">
                    <li class="flex-1 min-w-[150px]">
                        <a class="tab-link py-4 px-6 block text-center hover:bg-gray-50 active" data-tab="penelitian">
                            <i class="fas fa-flask mr-2"></i>Penelitian
                        </a>
                    </li>
                    <li class="flex-1 min-w-[150px]">
                        <a class="tab-link py-4 px-6 block text-center hover:bg-gray-50" data-tab="pengabdian">
                            <i class="fas fa-hands-helping mr-2"></i>Pengabdian
                        </a>
                    </li>
                    <li class="flex-1 min-w-[150px]">
                        <a class="tab-link py-4 px-6 block text-center hover:bg-gray-50" data-tab="haki">
                            <i class="fas fa-copyright mr-2"></i>HAKI
                        </a>
                    </li>
                    <li class="flex-1 min-w-[150px]">
                        <a class="tab-link py-4 px-6 block text-center hover:bg-gray-50" data-tab="paten">
                            <i class="fas fa-certificate mr-2"></i>Paten
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="p-4 overflow-x-auto">
                <!-- Penelitian Tab -->
                <div id="penelitian" class="tab-content">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Data Penelitian</h3>
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Judul Penelitian</th>
                                <th class="py-3 px-4 text-left">Skema</th>
                                <th class="py-3 px-4 text-left">Posisi</th>
                                <th class="py-3 px-4 text-left">Sumber Dana</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Tahun</th>
                                <th class="py-3 px-4 text-left rounded-tr-lg">Luaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($dosen->penelitians as $penelitian)
                                <tr class="table-row">
                                    <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                    <td class="py-3 px-4 border-b max-w-xs">{{ $penelitian->judul_penelitian }}</td>
                                    <td class="py-3 px-4 border-b">{{ $penelitian->skema }}</td>
                                    <td class="py-3 px-4 border-b">{{ $penelitian->posisi }}</td>
                                    <td class="py-3 px-4 border-b">{{ $penelitian->sumber_dana }}</td>
                                    <td class="py-3 px-4 border-b">
                                        <span class="status-badge {{ $penelitian->status == 'Selesai' ? 'status-selesai' : ($penelitian->status == 'Berjalan' ? 'status-berjalan' : 'status-diajukan') }}">
                                            {{ $penelitian->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b">{{ $penelitian->tahun }}</td>
                                    <td class="py-3 px-4 border-b">
                                        @if ($penelitian->link_luaran)
                                            <a href="{{ $penelitian->link_luaran }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">
                                                <i class="fas fa-external-link-alt text-xs"></i> Link
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pengabdian Tab -->
                <div id="pengabdian" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Data Pengabdian</h3>
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Judul Pengabdian</th>
                                <th class="py-3 px-4 text-left">Skema</th>
                                <th class="py-3 px-4 text-left">Posisi</th>
                                <th class="py-3 px-4 text-left">Sumber Dana</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Tahun</th>
                                <th class="py-3 px-4 text-left rounded-tr-lg">Luaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($dosen->pengabdians as $pengabdian)
                                <tr class="table-row">
                                    <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                    <td class="py-3 px-4 border-b max-w-xs">{{ $pengabdian->judul_pengabdian }}</td>
                                    <td class="py-3 px-4 border-b">{{ $pengabdian->skema }}</td>
                                    <td class="py-3 px-4 border-b">{{ $pengabdian->posisi }}</td>
                                    <td class="py-3 px-4 border-b">{{ $pengabdian->sumber_dana }}</td>
                                    <td class="py-3 px-4 border-b">
                                        <span class="status-badge {{ $pengabdian->status == 'Selesai' ? 'status-selesai' : ($pengabdian->status == 'Berjalan' ? 'status-berjalan' : 'status-diajukan') }}">
                                            {{ $pengabdian->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b">{{ $pengabdian->tahun }}</td>
                                    <td class="py-3 px-4 border-b">
                                        @if ($pengabdian->link_luaran)
                                            <a href="{{ $pengabdian->link_luaran }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">
                                                <i class="fas fa-external-link-alt text-xs"></i> Link
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- HAKI Tab -->
                <div id="haki" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Data HAKI</h3>
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Judul HAKI</th>
                                <th class="py-3 px-4 text-left">Expired</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left rounded-tr-lg">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($dosen->hakis as $haki)
                                <tr class="table-row">
                                    <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                    <td class="py-3 px-4 border-b max-w-xs">{{ $haki->judul_haki }}</td>
                                    <td class="py-3 px-4 border-b">
                                        @if ($haki->expired)
                                            {{ \Carbon\Carbon::parse($haki->expired)->format('d M Y') }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        @php
                                            $expiredDate = $haki->expired ? \Carbon\Carbon::parse($haki->expired) : null;
                                            $isExpired = $expiredDate && $expiredDate->isPast();
                                        @endphp
                                        <span class="status-badge {{ $isExpired ? 'status-berjalan' : 'status-selesai' }}">
                                            {{ $isExpired ? 'Expired' : 'Aktif' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        @if ($haki->link)
                                            <a href="{{ $haki->link }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">
                                                <i class="fas fa-external-link-alt text-xs"></i> Link
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paten Tab -->
                <div id="paten" class="tab-content hidden">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Data Paten</h3>
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Judul Paten</th>
                                <th class="py-3 px-4 text-left">Jenis</th>
                                <th class="py-3 px-4 text-left">Expired</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left rounded-tr-lg">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($dosen->patens as $paten)
                                <tr class="table-row">
                                    <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                    <td class="py-3 px-4 border-b max-w-xs">{{ $paten->judul_paten }}</td>
                                    <td class="py-3 px-4 border-b">{{ $paten->jenis_paten }}</td>
                                    <td class="py-3 px-4 border-b">
                                        @if ($paten->expired)
                                            {{ \Carbon\Carbon::parse($paten->expired)->format('d M Y') }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        @php
                                            $expiredDate = $paten->expired ? \Carbon\Carbon::parse($paten->expired) : null;
                                            $isExpired = $expiredDate && $expiredDate->isPast();
                                        @endphp
                                        <span class="status-badge {{ $isExpired ? 'status-berjalan' : 'status-selesai' }}">
                                            {{ $isExpired ? 'Expired' : 'Aktif' }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        @if ($paten->link)
                                            <a href="{{ $paten->link }}" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">
                                                <i class="fas fa-external-link-alt text-xs"></i> Link
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tab-link').click(function(e) {
                e.preventDefault();
                $('.tab-content').addClass('hidden');
                $('.tab-link').removeClass('active bg-gray-100');
                $('#' + $(this).data('tab')).removeClass('hidden');
                $(this).addClass('active');
            });

            $('.tab-link:first').click();
        });
    </script>
</body>
</html>