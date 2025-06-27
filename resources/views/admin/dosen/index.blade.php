<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Manajemen Dosen</h2>
            <div>
                <a href="{{ route('admin.dosen.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Dosen</a>
                <form action="{{ route('admin.dosen.import') }}" method="POST" enctype="multipart/form-data" class="inline-block">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls" class="inline-block">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Impor Excel</button>
                </form>
                <form action="{{ route('logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
                </form>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="tabs">
                <ul class="flex border-b">
                    <li class="mr-1">
                        <a class="tab-link bg-gray-100 px-4 py-2 inline-block" data-tab="penelitian">Penelitian</a>
                    </li>
                    <li class="mr-1">
                        <a class="tab-link px-4 py-2 inline-block" data-tab="pengabdian">Pengabdian</a>
                    </li>
                    <li class="mr-1">
                        <a class="tab-link px-4 py-2 inline-block" data-tab="haki">HAKI</a>
                    </li>
                    <li class="mr-1">
                        <a class="tab-link px-4 py-2 inline-block" data-tab="paten">Paten</a>
                    </li>
                </ul>
                <div id="penelitian" class="tab-content">
                    <h3 class="text-xl font-semibold mb-4">Data Penelitian</h3>
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">NIDN</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Skema</th>
                                <th class="border px-4 py-2">Posisi</th>
                                <th class="border px-4 py-2">Judul Penelitian</th>
                                <th class="border px-4 py-2">Sumber Dana</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">Tahun</th>
                                <th class="border px-4 py-2">Link Luaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($dosens as $dosen)
                                @foreach ($dosen->penelitians as $penelitian)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $no++ }}</td>
                                        <td class="border px-4 py-2">{{ $dosen->nidn }}</td>
                                        <td class="border px-4 py-2">{{ $dosen->nama }}</td>
                                        <td class="border px-4 py-2">{{ $penelitian->skema }}</td>
                                        <td class="border px-4 py-2">{{ $penelitian->posisi }}</td>
                                        <td class="border px-4 py-2">{{ $penelitian->judul_penelitian }}</td>
                                        <td class="border px-4 py-2">{{ $penelitian->sumber_dana }}</td>
                                        <td class="border px-4 py-2">{{ $penelitian->status }}</td>
                                        <td class="border px-4 py-2">{{ $penelitian->tahun }}</td>
                                        <td class="border px-4 py-2">
                                            @if ($penelitian->link_luaran)
                                                <a href="{{ $penelitian->link_luaran }}" target="_blank">Link</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="pengabdian" class="tab-content hidden">
                    <h3 class="text-xl font-semibold mb-4">Data Pengabdian</h3>
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">NIDN</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Skema</th>
                                <th class="border px-4 py-2">Posisi</th>
                                <th class="border px-4 py-2">Judul Pengabdian</th>
                                <th class="border px-4 py-2">Sumber Dana</th>
                                <th class="border px-4 py-2">Status</th>
                                <th class="border px-4 py-2">Tahun</th>
                                <th class="border px-4 py-2">Link Luaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($dosens as $dosen)
                                @foreach ($dosen->pengabdians as $pengabdian)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $no++ }}</td>
                                        <td class="border px-4 py-2">{{ $dosen->nidn }}</td>
                                        <td class="border px-4 py-2">{{ $dosen->nama }}</td>
                                        <td class="border px-4 py-2">{{ $pengabdian->skema }}</td>
                                        <td class="border px-4 py-2">{{ $pengabdian->posisi }}</td>
                                        <td class="border px-4 py-2">{{ $pengabdian->judul_pengabdian }}</td>
                                        <td class="border px-4 py-2">{{ $pengabdian->sumber_dana }}</td>
                                        <td class="border px-4 py-2">{{ $pengabdian->status }}</td>
                                        <td class="border px-4 py-2">{{ $pengabdian->tahun }}</td>
                                        <td class="border px-4 py-2">
                                            @if ($pengabdian->link_luaran)
                                                <a href="{{ $pengabdian->link_luaran }}" target="_blank">Link</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="haki" class="tab-content hidden">
                    <h3 class="text-xl font-semibold mb-4">Data HAKI</h3>
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">NIDN</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Judul HAKI</th>
                                <th class="border px-4 py-2">Expired</th>
                                <th class="border px-4 py-2">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($dosens as $dosen)
                                @foreach ($dosen->hakis as $haki)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $no++ }}</td>
                                        <td class="border px-4 py-2">{{ $dosen->nidn }}</td>
                                        <td class="border px-4 py-2">{{ $dosen->nama }}</td>
                                        <td class="border px-4 py-2">{{ $haki->judul_haki }}</td>
                                        <td class="border px-4 py-2">
                                            @if ($haki->expired)
                                                {{ \Carbon\Carbon::parse($haki->expired)->format('Y-m-d') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($haki->link)
                                                <a href="{{ $haki->link }}" target="_blank">Link</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="paten" class="tab-content hidden">
                    <h3 class="text-xl font-semibold mb-4">Data Paten</h3>
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">NIDN</th>
                                <th class="border px-4 py-2">Nama</th>
                                <th class="border px-4 py-2">Judul Paten</th>
                                <th class="border px-4 py-2">Jenis Paten</th>
                                <th class="border px-4 py-2">Expired</th>
                                <th class="border px-4 py-2">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($dosens as $dosen)
                                @foreach ($dosen->patens as $paten)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $no++ }}</td>
                                        <td class="border px-4 py-2">{{ $dosen->nidn }}</td>
                                        <td class="border px-4 py-2">{{ $dosen->nama }}</td>
                                        <td class="border px-4 py-2">{{ $paten->judul_paten }}</td>
                                        <td class="border px-4 py-2">{{ $paten->jenis_paten }}</td>
                                        <td class="border px-4 py-2">
                                            @if ($paten->expired)
                                                {{ \Carbon\Carbon::parse($paten->expired)->format('Y-m-d') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if ($paten->link)
                                                <a href="{{ $paten->link }}" target="_blank">Link</a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.tab-link').click(function() {
                $('.tab-content').addClass('hidden');
                $('.tab-link').removeClass('bg-gray-100');
                $('#' + $(this).data('tab')).removeClass('hidden');
                $(this).addClass('bg-gray-100');
            });
        });
    </script>
</body>
</html>