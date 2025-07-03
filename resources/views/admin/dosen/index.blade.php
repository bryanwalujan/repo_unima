<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Dosen - UNIMA</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .tab-link.active {
            @apply bg-white text-green-700 border-t-2 border-green-600 font-medium;
        }
        .status-badge {
            @apply px-2 py-1 rounded-full text-xs font-medium;
        }
        .status-selesai { @apply bg-green-100 text-green-800; }
        .status-berjalan { @apply bg-yellow-100 text-yellow-800; }
        .status-diajukan { @apply bg-blue-100 text-blue-800; }
        .card-shadow { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); }
        .action-btn { @apply transition-all duration-200 hover:opacity-80; }
        .table-row:hover { @apply bg-gray-50; }
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .file-input-wrapper input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-user-tie text-green-600 mr-2"></i>Manajemen Data Dosen
                </h1>
                <p class="text-gray-600 mt-1">Repositori Fakultas Teknik Informatika UNIMA</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <a href="{{ route('admin.dosen.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2">
                    <i class="fas fa-plus-circle"></i> Tambah Dosen
                </a>
                
                <div class="flex gap-2">
                    <form id="import-dosen-form" action="{{ route('admin.dosen.import') }}" method="POST" enctype="multipart/form-data" class="flex">
                        @csrf
                        <div class="file-input-wrapper">
                            <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-l-lg flex items-center gap-2">
                                <i class="fas fa-file-excel"></i> Pilih File
                            </button>
                            <input type="file" name="file" accept=".xlsx,.xls" id="fileInput">
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-r-lg flex items-center gap-2">
                            <i class="fas fa-upload"></i> Impor
                        </button>
                    </form>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 h-full">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl card-shadow overflow-hidden">
            <!-- Tab Navigation -->
            <div class="border-b">
                <ul class="flex flex-wrap">
                    <li class="flex-1 min-w-[150px]">
                        <a class="tab-link py-4 px-6 block text-center hover:bg-gray-50 active" data-tab="dosen">
                            <i class="fas fa-user-tie mr-2"></i>Data Dosen
                        </a>
                    </li>
                    <li class="flex-1 min-w-[150px]">
                        <a class="tab-link py-4 px-6 block text-center hover:bg-gray-50" data-tab="penelitian">
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
                <!-- Data Dosen Tab -->
                <div id="dosen" class="tab-content">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-3">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-user-tie text-green-600 mr-2"></i> Data Dosen
                        </h3>
                        <div class="relative w-full md:w-64">
                            <input type="text" placeholder="Cari data dosen..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 search-dosen">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Foto</th>
                                <th class="py-3 px-4 text-left">Nama</th>
                                <th class="py-3 px-4 text-left">NIDN</th>
                                <th class="py-3 px-4 text-left">NIP</th>
                                <th class="py-3 px-4 text-left">NUPTK</th>
                                <th class="py-3 px-4 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if (isset($dosens) && is_iterable($dosens))
                                @foreach ($dosens as $dosen)
                                    <tr class="table-row">
                                        <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                        <td class="py-3 px-4 border-b">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($dosen->foto)
                                                    <img src="{{ Storage::url($dosen->foto) }}" alt="{{ $dosen->nama }}" class="h-10 w-10 rounded-full object-cover border">
                                                @else
                                                    <div class="bg-gray-200 border-2 border-dashed rounded-full w-10 h-10 flex items-center justify-center text-gray-500">
                                                        <i class="fas fa-user text-sm"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 border-b">
                                            <a href="{{ route('admin.dosen.show', $dosen->id) }}" class="font-medium text-blue-600 hover:underline">{{ $dosen->nama }}</a>
                                        </td>
                                        <td class="py-3 px-4 border-b">{{ $dosen->nidn }}</td>
                                        <td class="py-3 px-4 border-b">{{ $dosen->nip ?? '-' }}</td>
                                        <td class="py-3 px-4 border-b">{{ $dosen->nuptk ?? '-' }}</td>
                                        <td class="py-3 px-4 border-b">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="text-blue-600 hover:text-blue-800 action-btn" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 action-btn" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="py-3 px-4 text-center text-gray-500">Tidak ada data dosen tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Penelitian Tab -->
                <div id="penelitian" class="tab-content hidden">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-3">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-flask text-green-600 mr-2"></i> Data Penelitian
                        </h3>
                        <div class="relative w-full md:w-64">
                            <input type="text" placeholder="Cari data penelitian..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 search-penelitian">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Dosen</th>
                                <th class="py-3 px-4 text-left">Judul Penelitian</th>
                                <th class="py-3 px-4 text-left">Skema</th>
                                <th class="py-3 px-4 text-left">Posisi</th>
                                <th class="py-3 px-4 text-left">Sumber Dana</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Tahun</th>
                                <th class="py-3 px-4 text-left">Luaran</th>
                                <th class="py-3 px-4 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if (isset($dosens) && is_iterable($dosens))
                                @foreach ($dosens as $dosen)
                                    @if (is_iterable($dosen->penelitians))
                                        @foreach ($dosen->penelitians as $penelitian)
                                            <tr class="table-row">
                                                <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                                <td class="py-3 px-4 border-b">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            @if ($dosen->foto)
                                                                <img src="{{ Storage::url($dosen->foto) }}" alt="{{ $dosen->nama }}" class="h-10 w-10 rounded-full object-cover border">
                                                            @else
                                                                <div class="bg-gray-200 border-2 border-dashed rounded-full w-10 h-10 flex items-center justify-center text-gray-500">
                                                                    <i class="fas fa-user text-sm"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-3">
                                                            <a href="{{ route('admin.dosen.show', $dosen->id) }}" class="font-medium text-blue-600 hover:underline">{{ $dosen->nama }}</a>
                                                            <div class="text-gray-500 text-xs">{{ $dosen->nidn }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-4 border-b max-w-xs">
                                                    <div class="font-medium">{{ $penelitian->judul_penelitian }}</div>
                                                </td>
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
                                                <td class="py-3 px-4 border-b">
                                                    <div class="flex justify-center space-x-2">
                                                        <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="text-blue-600 hover:text-blue-800 action-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800 action-btn" title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="py-3 px-4 text-center text-gray-500">Tidak ada data penelitian untuk {{ $dosen->nama }}.</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" class="py-3 px-4 text-center text-gray-500">Tidak ada data dosen tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pengabdian Tab -->
                <div id="pengabdian" class="tab-content hidden">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-3">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-hands-helping text-green-600 mr-2"></i> Data Pengabdian
                        </h3>
                        <div class="relative w-full md:w-64">
                            <input type="text" placeholder="Cari data pengabdian..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 search-pengabdian">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Dosen</th>
                                <th class="py-3 px-4 text-left">Judul Pengabdian</th>
                                <th class="py-3 px-4 text-left">Skema</th>
                                <th class="py-3 px-4 text-left">Posisi</th>
                                <th class="py-3 px-4 text-left">Sumber Dana</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Tahun</th>
                                <th class="py-3 px-4 text-left">Luaran</th>
                                <th class="py-3 px-4 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if (isset($dosens) && is_iterable($dosens))
                                @foreach ($dosens as $dosen)
                                    @if (is_iterable($dosen->pengabdians))
                                        @foreach ($dosen->pengabdians as $pengabdian)
                                            <tr class="table-row">
                                                <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                                <td class="py-3 px-4 border-b">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            @if ($dosen->foto)
                                                                <img src="{{ Storage::url($dosen->foto) }}" alt="{{ $dosen->nama }}" class="h-10 w-10 rounded-full object-cover border">
                                                            @else
                                                                <div class="bg-gray-200 border-2 border-dashed rounded-full w-10 h-10 flex items-center justify-center text-gray-500">
                                                                    <i class="fas fa-user text-sm"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-3">
                                                            <a href="{{ route('admin.dosen.show', $dosen->id) }}" class="font-medium text-blue-600 hover:underline">{{ $dosen->nama }}</a>
                                                            <div class="text-gray-500 text-xs">{{ $dosen->nidn }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-4 border-b max-w-xs">
                                                    <div class="font-medium">{{ $pengabdian->judul_pengabdian }}</div>
                                                </td>
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
                                                <td class="py-3 px-4 border-b">
                                                    <div class="flex justify-center space-x-2">
                                                        <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="text-blue-600 hover:text-blue-800 action-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800 action-btn" title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="py-3 px-4 text-center text-gray-500">Tidak ada data pengabdian untuk {{ $dosen->nama }}.</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" class="py-3 px-4 text-center text-gray-500">Tidak ada data dosen tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- HAKI Tab -->
                <div id="haki" class="tab-content hidden">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-3">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-copyright text-green-600 mr-2"></i> Data HAKI
                        </h3>
                        <div class="relative w-full md:w-64">
                            <input type="text" placeholder="Cari data HAKI..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 search-haki">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Dosen</th>
                                <th class="py-3 px-4 text-left">Judul HAKI</th>
                                <th class="py-3 px-4 text-left">Expired</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Link</th>
                                <th class="py-3 px-4 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if (isset($dosens) && is_iterable($dosens))
                                @foreach ($dosens as $dosen)
                                    @if (is_iterable($dosen->hakis))
                                        @foreach ($dosen->hakis as $haki)
                                            <tr class="table-row">
                                                <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                                <td class="py-3 px-4 border-b">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            @if ($dosen->foto)
                                                                <img src="{{ Storage::url($dosen->foto) }}" alt="{{ $dosen->nama }}" class="h-10 w-10 rounded-full object-cover border">
                                                            @else
                                                                <div class="bg-gray-200 border-2 border-dashed rounded-full w-10 h-10 flex items-center justify-center text-gray-500">
                                                                    <i class="fas fa-user text-sm"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-3">
                                                            <a href="{{ route('admin.dosen.show', $dosen->id) }}" class="font-medium text-blue-600 hover:underline">{{ $dosen->nama }}</a>
                                                            <div class="text-gray-500 text-xs">{{ $dosen->nidn }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-4 border-b max-w-xs">
                                                    <div class="font-medium">{{ $haki->judul_haki }}</div>
                                                </td>
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
                                                <td class="py-3 px-4 border-b">
                                                    <div class="flex justify-center space-x-2">
                                                        <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="text-blue-600 hover:text-blue-800 action-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800 action-btn" title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="py-3 px-4 text-center text-gray-500">Tidak ada data HAKI untuk {{ $dosen->nama }}.</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="py-3 px-4 text-center text-gray-500">Tidak ada data dosen tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Paten Tab -->
                <div id="paten" class="tab-content hidden">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-3">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-certificate text-green-600 mr-2"></i> Data Paten
                        </h3>
                        <div class="relative w-full md:w-64">
                            <input type="text" placeholder="Cari data paten..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-300 focus:border-green-500 search-paten">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    
                    <table class="w-full min-w-max">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="py-3 px-4 text-left rounded-tl-lg">No</th>
                                <th class="py-3 px-4 text-left">Dosen</th>
                                <th class="py-3 px-4 text-left">Judul Paten</th>
                                <th class="py-3 px-4 text-left">Jenis</th>
                                <th class="py-3 px-4 text-left">Expired</th>
                                <th class="py-3 px-4 text-left">Status</th>
                                <th class="py-3 px-4 text-left">Link</th>
                                <th class="py-3 px-4 text-center rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if (isset($dosens) && is_iterable($dosens))
                                @foreach ($dosens as $dosen)
                                    @if (is_iterable($dosen->patens))
                                        @foreach ($dosen->patens as $paten)
                                            <tr class="table-row">
                                                <td class="py-3 px-4 border-b">{{ $no++ }}</td>
                                                <td class="py-3 px-4 border-b">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            @if ($dosen->foto)
                                                                <img src="{{ Storage::url($dosen->foto) }}" alt="{{ $dosen->nama }}" class="h-10 w-10 rounded-full object-cover border">
                                                            @else
                                                                <div class="bg-gray-200 border-2 border-dashed rounded-full w-10 h-10 flex items-center justify-center text-gray-500">
                                                                    <i class="fas fa-user text-sm"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-3">
                                                            <a href="{{ route('admin.dosen.show', $dosen->id) }}" class="font-medium text-blue-600 hover:underline">{{ $dosen->nama }}</a>
                                                            <div class="text-gray-500 text-xs">{{ $dosen->nidn }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-4 border-b max-w-xs">
                                                    <div class="font-medium">{{ $paten->judul_paten }}</div>
                                                </td>
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
                                                <td class="py-3 px-4 border-b">
                                                    <div class="flex justify-center space-x-2">
                                                        <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="text-blue-600 hover:text-blue-800 action-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800 action-btn" title="Hapus">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="py-3 px-4 text-center text-gray-500">Tidak ada data paten untuk {{ $dosen->nama }}.</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="py-3 px-4 text-center text-gray-500">Tidak ada data dosen tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Tab switching functionality
            $('.tab-link').click(function(e) {
                e.preventDefault();
                $('.tab-content').addClass('hidden');
                $('.tab-link').removeClass('active bg-gray-100');
                $('#' + $(this).data('tab')).removeClass('hidden');
                $(this).addClass('active');
            });

            // Initialize first tab
            $('.tab-link:first').click();
            
            // File input styling
            $('#fileInput').change(function() {
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    $(this).siblings('button').html(`<i class="fas fa-file-excel"></i> ${fileName}`);
                }
            });

            // Search functionality
            $('.search-dosen').on('input', function() {
                let value = $(this).val().toLowerCase();
                $('#dosen tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $('.search-penelitian').on('input', function() {
                let value = $(this).val().toLowerCase();
                $('#penelitian tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $('.search-pengabdian').on('input', function() {
                let value = $(this).val().toLowerCase();
                $('#pengabdian tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $('.search-haki').on('input', function() {
                let value = $(this).val().toLowerCase();
                $('#haki tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $('.search-paten').on('input', function() {
                let value = $(this).val().toLowerCase();
                $('#paten tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // SweetAlert2 for delete confirmation
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                Swal.fire({
                    title: 'Yakin ingin menghapus data ini?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: $(form).attr('action'),
                            method: $(form).attr('method'),
                            data: $(form).serialize(),
                            success: function(response) {
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: response.message || 'Data berhasil dihapus.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus data.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });

            // SweetAlert2 for import form
            $('#import-dosen-form').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);
                Swal.fire({
                    title: 'Mengimpor data...',
                    text: 'Harap tunggu sebentar.',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: 'Sukses!',
                            text: response.message || 'Data berhasil diimpor.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan saat mengimpor data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // SweetAlert2 for flash messages (success/error)
            @if (session('success'))
                Swal.fire({
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>
</html>