<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositori Dosen | Teknik Informatika - Universitas Negeri Manado</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <!-- Tambahkan logo UNIMA sebagai favicon -->
    <link rel="icon" href="{{ asset('images/logo/unima-logo.png') }}" type="image/png">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --unima-blue: #1e3a8a;
            --unima-gold: #d4af37;
            --unima-light-blue: #3b82f6;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #f0f7ff, #e6f2ff);
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .unima-blue {
            background-color: var(--unima-blue);
        }
        
        .unima-gold {
            color: var(--unima-gold);
        }
        
        .card-shadow {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
        }
        
        .card-shadow:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .tab-active {
            position: relative;
            color: var(--unima-blue);
            font-weight: 600;
            background-color: #f0f7ff;
        }
        
        .tab-active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--unima-light-blue);
        }
        
        .search-input {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' class='h-6 w-6' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 24px center;
            background-size: 24px;
            padding-left: 64px;
            border-radius: 14px;
        }
        
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .hero-pattern {
            background-image: radial-gradient(circle, rgba(30,58,138,0.08) 2px, transparent 2px);
            background-size: 40px 40px;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--unima-blue) 0%, #0f2c6e 100%);
        }
        
        .highlight-card {
            position: relative;
            overflow: hidden;
        }
        
        .highlight-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }
        
        .stat-badge {
            background: linear-gradient(135deg, var(--unima-light-blue) 0%, var(--unima-blue) 100%);
            color: white;
            border-radius: 50px;
            padding: 6px 18px;
            display: inline-flex;
            align-items: center;
            font-weight: 500;
        }
        
        .profile-border {
            border: 4px solid white;
            box-shadow: 0 0 0 4px var(--unima-light-blue);
        }
        
        .glow-hover:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }
        
        .portfolio-tab {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px 24px;
            min-width: 140px;
            transition: all 0.3s ease;
            border-radius: 8px 8px 0 0;
        }
        
        .portfolio-tab .tab-icon {
            font-size: 24px;
            margin-bottom: 8px;
        }
        
        .portfolio-tab .tab-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .portfolio-tab .tab-count {
            background-color: #e2e8f0;
            color: #4a5568;
            border-radius: 12px;
            padding: 2px 10px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .portfolio-tab:hover, .portfolio-tab.tab-active {
            background-color: #f0f7ff;
        }
        
        .portfolio-tab.tab-active .tab-title {
            color: var(--unima-blue);
        }
        
        .portfolio-tab.tab-active .tab-count {
            background-color: var(--unima-light-blue);
            color: white;
        }
        
        .portfolio-section {
            padding: 24px;
            background: #f8fafc;
            border-radius: 0 0 12px 12px;
        }
        
        /* Styling untuk tabel yang lebih informatif */
        .portfolio-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .portfolio-table thead {
            background: linear-gradient(135deg, var(--unima-light-blue) 0%, var(--unima-blue) 100%);
            color: white;
        }
        
        .portfolio-table th {
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .portfolio-table td {
            padding: 14px 20px;
            border-bottom: 1px solid #e2e8f0;
            background-color: white;
        }
        
        .portfolio-table tbody tr {
            transition: background-color 0.2s;
        }
        
        .portfolio-table tbody tr:hover {
            background-color: #f0f7ff;
        }
        
        .portfolio-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        
        .status-active {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .status-pending {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        .status-expired {
            background-color: #fee2e2;
            color: #b91c1c;
        }
        
        /* Tambahan untuk footer */
        .footer-container {
            margin-top: auto;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header with Floating Elements -->
    <header class="gradient-bg text-white shadow-xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-blue-300 opacity-20"></div>
            <div class="absolute top-40 right-20 w-24 h-24 rounded-full bg-blue-200 opacity-15"></div>
            <div class="absolute bottom-10 left-1/4 w-32 h-32 rounded-full bg-blue-300 opacity-10"></div>
        </div>
        
        <div class="container mx-auto px-4 py-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <!-- Tambahkan Logo UNIMA di sini -->
                    <img src="{{ asset('images/logo/unima-logo.png') }}" 
     alt="Logo UNIMA" 
     class="h-24 w-auto md:h-32x mr-4 filter drop-shadow-xl">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold flex items-center">
                            <span>Repositori Dosen</span>
                            <span class="ml-2 text-yellow-400 text-xl"><i class="fas fa-star"></i></span>
                        </h1>
                        <p class="text-yellow-300 font-medium flex items-center">
                            <i class="fas fa-university mr-2"></i>Teknik Informatika - Universitas Negeri Manado
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <div class="hero-pattern py-12 relative overflow-hidden">
        <div class="absolute top-10 right-10 opacity-10">
            <i class="fas fa-atom text-[200px] text-blue-500"></i>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-10 md:mb-0 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 leading-tight">
                            Temukan Dosen & Karya Inovasi 
                            <span class="text-blue-600">Teknik Informatika</span>
                        </h1>
                        <p class="text-gray-600 text-lg mb-6 max-w-xl">
                            Jelajahi profil dosen, penelitian, pengabdian, dan karya inovatif 
                            Program Studi Teknik Informatika Universitas Negeri Manado
                        </p>
                        <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                            <div class="stat-badge">
                                <i class="fas fa-users mr-2"></i> 30 Dosen
                            </div>
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 flex justify-center">
                        <div class="relative">
                            <div class="floating">
                                <img src="https://cdn.pixabay.com/photo/2018/03/10/12/00/teamwork-3213924_1280.jpg" alt="Teamwork" class="w-80 h-80 object-cover rounded-xl shadow-xl border-8 border-white">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="container mx-auto px-4 py-8 -mt-16 relative z-20">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl card-shadow overflow-hidden">
                <div class="gradient-bg text-white p-6">
                    <h2 class="text-2xl font-bold flex items-center">
                        <i class="fas fa-search mr-3"></i> Pencarian Dosen
                    </h2>
                    <p class="opacity-90">Cari dosen berdasarkan nama, NIDN</p>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('public.search') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="query" 
                                    value="{{ old('query', $query ?? '') }}" 
                                    placeholder="Contoh: Dr. Audy Kenap, atau 1234567890" 
                                    class="search-input w-full p-5 text-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >
                            </div>
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
                        
                        <button type="submit" class="w-full gradient-bg hover:opacity-90 text-white p-5 rounded-xl text-lg font-bold transition-all duration-300 flex items-center justify-center glow-hover">
                            <i class="fas fa-search mr-3"></i> Cari Dosen
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    <div class="container mx-auto px-4 py-8">
        @if (isset($dosens) && $dosens->count() > 0)
            <div class="space-y-8">
                @foreach ($dosens as $dosen)
                    <div class="bg-white rounded-2xl card-shadow overflow-hidden animate-fade-in">
                        <!-- Dosen Header -->
                        <div class="gradient-bg text-white p-8 relative overflow-hidden">
                            <div class="absolute top-0 right-0 opacity-20">
                                <i class="fas fa-atom text-[180px]"></i>
                            </div>
                            
                            <div class="flex flex-col md:flex-row items-center relative z-10">
                                <div class="mb-6 md:mb-0 md:mr-8">
                                    <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden profile-border">
                                        <img 
                                            src="{{ $dosen->foto ? Storage::url($dosen->foto) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80' }}" 
                                            alt="Foto Dosen {{ $dosen->nama }}" 
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                </div>
                                <div class="text-center md:text-left">
                                    <h2 class="text-3xl font-bold">{{ $dosen->nama }}</h2>
                                    <p class="text-blue-200 mt-2">
                                        <i class="fas fa-user-tie mr-2"></i>
                                        {{ $dosen->jabatan_akademik ?? 'Dosen Teknik Informatika' }}
                                    </p>
                                    
                                    <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                                        <div class="bg-blue-500/30 backdrop-blur px-4 py-2 rounded-full">
                                            <i class="fas fa-id-card mr-2"></i> NIDN: {{ $dosen->nidn ?? '-' }}
                                        </div>
                                        <div class="bg-blue-500/30 backdrop-blur px-4 py-2 rounded-full">
                                            <i class="fas fa-fingerprint mr-2"></i> NIP: {{ $dosen->nip ?? '-' }}
                                        </div>
                                        <div class="bg-blue-500/30 backdrop-blur px-4 py-2 rounded-full">
                                            <i class="fas fa-id-badge mr-2"></i> NUPTK: {{ $dosen->nuptk ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab Navigation - Diperbarui -->
                        <div class="border-b border-gray-200 bg-white">
                            <ul class="flex flex-wrap justify-center">
                                <li class="mx-1">
                                    <a class="portfolio-tab tab-link tab-active" data-tab="penelitian-{{ $dosen->id }}">
                                        <div class="tab-icon text-blue-600">
                                            <i class="fas fa-flask"></i>
                                        </div>
                                        <div class="tab-title">Penelitian</div>
                                        <div class="tab-count">{{ $dosen->penelitians->count() }}</div>
                                    </a>
                                </li>
                                <li class="mx-1">
                                    <a class="portfolio-tab tab-link" data-tab="pengabdian-{{ $dosen->id }}">
                                        <div class="tab-icon text-green-600">
                                            <i class="fas fa-hands-helping"></i>
                                        </div>
                                        <div class="tab-title">Pengabdian</div>
                                        <div class="tab-count">{{ $dosen->pengabdians->count() }}</div>
                                    </a>
                                </li>
                                <li class="mx-1">
                                    <a class="portfolio-tab tab-link" data-tab="haki-{{ $dosen->id }}">
                                        <div class="tab-icon text-purple-600">
                                            <i class="fas fa-copyright"></i>
                                        </div>
                                        <div class="tab-title">HAKI</div>
                                        <div class="tab-count">{{ $dosen->hakis->count() }}</div>
                                    </a>
                                </li>
                                <li class="mx-1">
                                    <a class="portfolio-tab tab-link" data-tab="paten-{{ $dosen->id }}">
                                        <div class="tab-icon text-yellow-600">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="tab-title">Paten</div>
                                        <div class="tab-count">{{ $dosen->patens->count() }}</div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Contents - Diperbarui dengan Tabel -->
                        <div class="portfolio-section">
                            <!-- Penelitian -->
                            <div id="penelitian-{{ $dosen->id }}" class="tab-content">
                                <div class="mb-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-flask text-blue-600 mr-2"></i>
                                        Penelitian Dosen
                                    </h3>
                                </div>
                                
                                @if($dosen->penelitians->count() > 0)
                                    <div class="overflow-x-auto rounded-lg">
                                        <table class="portfolio-table w-full">
                                            <thead>
                                                <tr>
                                                    <th class="w-4/12">Judul Penelitian</th>
                                                    <th>Skema</th>
                                                    <th>Tahun</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dosen->penelitians as $penelitian)
                                                <tr>
                                                    <td class="font-medium">{{ $penelitian->judul_penelitian }}</td>
                                                    <td>{{ $penelitian->skema }}</td>
                                                    <td>{{ $penelitian->tahun }}</td>
                                                    <td>
                                                        @if($penelitian->status === 'Selesai')
                                                            <span class="status-badge status-active">
                                                                <i class="fas fa-check-circle mr-1"></i>{{ $penelitian->status }}
                                                            </span>
                                                        @else
                                                            <span class="status-badge status-pending">
                                                                <i class="fas fa-spinner mr-1"></i>{{ $penelitian->status }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-12 text-center bg-blue-50 rounded-xl">
                                        <div class="inline-block p-6 bg-blue-100 rounded-full mb-4">
                                            <i class="fas fa-inbox text-4xl text-blue-500"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Penelitian</h3>
                                        <p class="text-gray-600">Dosen ini belum memiliki data penelitian yang tercatat dalam sistem</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Pengabdian -->
                            <div id="pengabdian-{{ $dosen->id }}" class="tab-content hidden">
                                <div class="mb-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-hands-helping text-green-600 mr-2"></i>
                                        Pengabdian Masyarakat
                                    </h3>
                                </div>
                                
                                @if($dosen->pengabdians->count() > 0)
                                    <div class="overflow-x-auto rounded-lg">
                                        <table class="portfolio-table w-full">
                                            <thead>
                                                <tr>
                                                    <th class="w-4/12">Judul Pengabdian</th>
                                                    <th>Skema</th>
                                                    <th>Tahun</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dosen->pengabdians as $pengabdian)
                                                <tr>
                                                    <td class="font-medium">{{ $pengabdian->judul_pengabdian }}</td>
                                                    <td>{{ $pengabdian->skema }}</td>
                                                    <td>{{ $pengabdian->tahun }}</td>
                                                    <td>
                                                        @if($pengabdian->status === 'Selesai')
                                                            <span class="status-badge status-active">
                                                                <i class="fas fa-check-circle mr-1"></i>{{ $pengabdian->status }}
                                                            </span>
                                                        @else
                                                            <span class="status-badge status-pending">
                                                                <i class="fas fa-spinner mr-1"></i>{{ $pengabdian->status }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-12 text-center bg-green-50 rounded-xl">
                                        <div class="inline-block p-6 bg-green-100 rounded-full mb-4">
                                            <i class="fas fa-inbox text-4xl text-green-500"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Pengabdian</h3>
                                        <p class="text-gray-600">Dosen ini belum memiliki data pengabdian masyarakat yang tercatat</p>
                                    </div>
                                @endif
                            </div>

                            <!-- HAKI -->
                            <div id="haki-{{ $dosen->id }}" class="tab-content hidden">
                                <div class="mb-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-copyright text-purple-600 mr-2"></i>
                                        Hak Kekayaan Intelektual
                                    </h3>
                                </div>
                                
                                @if($dosen->hakis->count() > 0)
                                    <div class="overflow-x-auto rounded-lg">
                                        <table class="portfolio-table w-full">
                                            <thead>
                                                <tr>
                                                    <th class="w-4/12">Judul HAKI</th>
                                                    <th>Expired</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dosen->hakis as $haki)
                                                <tr>
                                                    <td class="font-medium">{{ $haki->judul_haki }}</td>
                                                    <td>
                                                        @if($haki->expired)
                                                            {{ \Carbon\Carbon::parse($haki->expired)->format('d M Y') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($haki->expired && \Carbon\Carbon::parse($haki->expired)->isFuture())
                                                            <span class="status-badge status-active">
                                                                <i class="fas fa-check-circle mr-1"></i>Aktif
                                                            </span>
                                                        @else
                                                            <span class="status-badge status-expired">
                                                                <i class="fas fa-exclamation-triangle mr-1"></i>Kadaluarsa
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-12 text-center bg-purple-50 rounded-xl">
                                        <div class="inline-block p-6 bg-purple-100 rounded-full mb-4">
                                            <i class="fas fa-inbox text-4xl text-purple-500"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data HAKI</h3>
                                        <p class="text-gray-600">Dosen ini belum memiliki data Hak Kekayaan Intelektual yang tercatat</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Paten -->
                            <div id="paten-{{ $dosen->id }}" class="tab-content hidden">
                                <div class="mb-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-file-certificate text-yellow-600 mr-2"></i>
                                        Paten dan Inovasi
                                    </h3>
                                </div>
                                
                                @if($dosen->patens->count() > 0)
                                    <div class="overflow-x-auto rounded-lg">
                                        <table class="portfolio-table w-full">
                                            <thead>
                                                <tr>
                                                    <th class="w-4/12">Judul Paten</th>
                                                    <th>Jenis Paten</th>
                                                    <th>Expired</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dosen->patens as $paten)
                                                <tr>
                                                    <td class="font-medium">{{ $paten->judul_paten }}</td>
                                                    <td>{{ $paten->jenis_paten }}</td>
                                                    <td>
                                                        @if($paten->expired)
                                                            {{ \Carbon\Carbon::parse($paten->expired)->format('d M Y') }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($paten->expired && \Carbon\Carbon::parse($paten->expired)->isFuture())
                                                            <span class="status-badge status-active">
                                                                <i class="fas fa-check-circle mr-1"></i>Aktif
                                                            </span>
                                                        @else
                                                            <span class="status-badge status-expired">
                                                                <i class="fas fa-exclamation-triangle mr-1"></i>Kadaluarsa
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="py-12 text-center bg-yellow-50 rounded-xl">
                                        <div class="inline-block p-6 bg-yellow-100 rounded-full mb-4">
                                            <i class="fas fa-inbox text-4xl text-yellow-500"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Paten</h3>
                                        <p class="text-gray-600">Dosen ini belum memiliki data paten yang tercatat</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif (isset($dosens))
            <div class="bg-white rounded-2xl card-shadow p-12 text-center max-w-3xl mx-auto animate-fade-in">
                <div class="text-6xl text-blue-500 mb-6">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Dosen Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-8 max-w-xl mx-auto">
                    Tidak ada hasil untuk pencarian "{{ $query }}". Silakan coba dengan kata kunci lain atau 
                    periksa kembali ejaan nama dosen.
                </p>
                <div class="inline-block bg-blue-100 text-blue-800 px-6 py-3 rounded-full font-medium">
                    <i class="fas fa-lightbulb mr-2"></i>Tips: Gunakan hanya nama depan atau NIDN untuk hasil lebih akurat
                </div>
            </div>
        @endif
    </div>

   

    <!-- Footer - Layout yang diperbaiki -->
    <footer class="bg-gray-900 text-white py-12 footer-container mt-auto">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Kolom 1: Info Repositori (Lebih lebar) -->
                <div class="md:col-span-1">
                    <h3 class="text-xl font-bold mb-6 flex items-center">
                        <div class="bg-blue-600 p-2 rounded-lg mr-3">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        Repositori Dosen
                    </h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Sistem informasi repositori dosen Program Studi Teknik Informatika 
                        Universitas Negeri Manado untuk mendukung transparansi dan akuntabilitas akademik.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-xl hover:transform hover:scale-110">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-xl hover:transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-xl hover:transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-xl hover:transform hover:scale-110">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-xl hover:transform hover:scale-110">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Kolom 2: Tautan Cepat -->
                <div>
                    <h3 class="text-xl font-bold mb-6 flex items-center">
                        <div class="bg-blue-600 p-2 rounded-lg mr-3">
                            <i class="fas fa-link"></i>
                        </div>
                        Tautan Cepat
                    </h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center group">
                            <i class="fas fa-chevron-right mr-3 text-xs text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                            Universitas Negeri Manado
                        </a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center group">
                            <i class="fas fa-chevron-right mr-3 text-xs text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                            Fakultas Teknik
                        </a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center group">
                            <i class="fas fa-chevron-right mr-3 text-xs text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                            Pangkalan Data Dikti
                        </a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center group">
                            <i class="fas fa-chevron-right mr-3 text-xs text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                            Portal Akademik
                        </a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center group">
                            <i class="fas fa-chevron-right mr-3 text-xs text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                            Sistem Informasi Akademik
                        </a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white hover:pl-2 transition-all duration-300 flex items-center group">
                            <i class="fas fa-chevron-right mr-3 text-xs text-blue-400 group-hover:translate-x-1 transition-transform"></i>
                            Perpustakaan Digital
                        </a></li>
                    </ul>
                </div>
                
                <!-- Kolom 3: Kontak Kami -->
                <div>
                    <h3 class="text-xl font-bold mb-6 flex items-center">
                        <div class="bg-blue-600 p-2 rounded-lg mr-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        Kontak Kami
                    </h3>
                    <ul class="space-y-5">
                        <li class="flex items-start group">
                            <i class="fas fa-map-marker-alt mt-1 mr-4 text-blue-400 group-hover:text-blue-300 transition-colors"></i>
                            <span class="text-gray-400 group-hover:text-gray-300 transition-colors leading-relaxed">
                                Jalan Kampus Unima, Kelurahan Koya, Tondano Selatan, Minahasa, Sulawesi Utara
                            </span>
                        </li>
                        <li class="flex items-center group hover:bg-gray-800 p-2 -m-2 rounded transition-colors">
                            <i class="fas fa-phone mr-4 text-blue-400 group-hover:text-blue-300 transition-colors"></i>
                            <span class="text-gray-400 group-hover:text-gray-300 transition-colors">(0431) 1234567</span>
                        </li>
                        <li class="flex items-center group hover:bg-gray-800 p-2 -m-2 rounded transition-colors">
                            <i class="fas fa-envelope mr-4 text-blue-400 group-hover:text-blue-300 transition-colors"></i>
                            <span class="text-gray-400 group-hover:text-gray-300 transition-colors">informatika@unima.ac.id</span>
                        </li>
                        <li class="flex items-center group hover:bg-gray-800 p-2 -m-2 rounded transition-colors">
                            <i class="fas fa-clock mr-4 text-blue-400 group-hover:text-blue-300 transition-colors"></i>
                            <span class="text-gray-400 group-hover:text-gray-300 transition-colors">Senin-Jumat: 08:00 - 16:00 WITA</span>
                        </li>
                        <li class="flex items-center group hover:bg-gray-800 p-2 -m-2 rounded transition-colors">
                            <i class="fas fa-globe mr-4 text-blue-400 group-hover:text-blue-300 transition-colors"></i>
                            <span class="text-gray-400 group-hover:text-gray-300 transition-colors">www.unima.ac.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Copyright Section -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-500 text-center md:text-left mb-4 md:mb-0">
                        &copy; 2025 Repositori Dosen - Teknik Informatika Universitas Negeri Manado. Hak Cipta Dilindungi.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-500 hover:text-white transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="text-gray-500 hover:text-white transition-colors">Syarat & Ketentuan</a>
                        <a href="#" class="text-gray-500 hover:text-white transition-colors">Bantuan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('.tab-link');
            
            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active classes from all tabs
                    tabLinks.forEach(l => {
                        l.classList.remove('tab-active');
                        l.classList.remove('text-blue-600');
                        l.classList.add('text-gray-600');
                    });
                    
                    // Add active class to clicked tab
                    this.classList.add('tab-active');
                    this.classList.add('text-blue-600');
                    this.classList.remove('text-gray-600');
                    
                    // Hide all tab contents
                    const tabContents = document.querySelectorAll('.tab-content');
                    tabContents.forEach(content => content.classList.add('hidden'));
                    
                    // Show the selected tab content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).classList.remove('hidden');
                });
            });
            
            // Activate first tab by default
            if (tabLinks.length > 0) {
                tabLinks[0].classList.add('tab-active');
                tabLinks[0].classList.add('text-blue-600');
                tabLinks[0].classList.remove('text-gray-600');
            }
        });
    </script>
</body>
</html>