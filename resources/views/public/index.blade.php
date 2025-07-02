<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositori Dosen | Teknik Informatika - Universitas Negeri Manado</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="icon" href="{{ asset('images/logo/unima-logo.png') }}" type="image/png">
</head>
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
        margin: 0;
    }

    .unima-blue {
        background-color: var(--unima-blue);
    }

    .unima-gold {
        color: var(--unima-gold);
    }

    .card-shadow {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-radius: 16px;
        overflow: hidden;
        background: white;
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
        transition: all 0.3s ease;
    }

    .search-input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
        background-image: radial-gradient(circle, rgba(30, 58, 138, 0.08) 2px, transparent 2px);
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
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 70%);
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
        transition: all 0.3s ease;
    }

    .stat-badge.clickable {
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .stat-badge.clickable:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        background: linear-gradient(135deg, #2b6cb0 0%, #1e3a8a 100%);
    }

    .profile-border {
        border: 4px solid white;
        box-shadow: 0 0 0 4px var(--unima-light-blue);
        transition: all 0.3s ease;
    }

    .profile-border:hover {
        transform: scale(1.05);
        box-shadow: 0 0 0 4px var(--unima-light-blue), 0 0 20px rgba(59, 130, 246, 0.5);
    }

    .glow-hover:hover {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        transform: translateY(-2px);
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
        cursor: pointer;
    }

    .portfolio-tab .tab-icon {
        font-size: 24px;
        margin-bottom: 8px;
        transition: transform 0.3s ease;
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
        transition: all 0.3s ease;
    }

    .portfolio-tab:hover,
    .portfolio-tab.tab-active {
        background-color: #f0f7ff;
    }

    .portfolio-tab:hover .tab-icon {
        transform: scale(1.2);
    }

    .portfolio-tab:hover .tab-count {
        background-color: var(--unima-light-blue);
        color: white;
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

    .portfolio-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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
        transition: all 0.3s ease;
    }

    .portfolio-table tbody tr {
        transition: background-color 0.2s;
    }

    .portfolio-table tbody tr:hover {
        background-color: #f0f7ff;
    }

    .portfolio-table tbody tr:hover td {
        transform: translateX(5px);
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
        transition: all 0.3s ease;
    }

    .status-badge:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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

    .footer-container {
        margin-top: auto;
    }

    .skema-filter {
        display: flex;
        gap: 8px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .skema-filter a {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 12px 16px;
        min-width: 120px;
        transition: all 0.3s ease;
        border-radius: 8px;
        background: #f0f7ff;
        cursor: pointer;
    }

    .skema-filter a:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .skema-filter a.tab-active {
        background: var(--unima-light-blue);
        color: white;
    }

    .container-wide {
        max-width: 1280px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 2rem;
        padding-right: 2rem;
        width: 100%;
    }

    .card-container {
        margin: 0 auto;
        max-width: 1280px;
        padding: 0 2rem;
    }

    .section-spacing {
        padding: 3rem 0;
    }

    .content-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .main-content {
        flex: 1;
    }

    .search-card {
        margin-top: -5rem;
        position: relative;
        z-index: 10;
    }

    .dosen-card {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .dosen-header {
        padding: 2rem;
    }

    .dosen-content {
        padding: 1.5rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .tab-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .tab-item {
        flex: 1;
        min-width: 200px;
        max-width: 250px;
    }

    .search-container {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 2rem;
        position: relative;
        z-index: 20;
    }

    .search-card-wide {
        width: 100%;
        margin-top: -5rem;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .search-card-wide:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .search-form {
        padding: 2rem;
    }

    .footer-link {
        transition: all 0.3s ease;
    }

    .footer-link:hover {
        color: #93c5fd;
        transform: translateX(5px);
    }

    .social-icon {
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        transform: scale(1.2) translateY(-5px);
        color: #3b82f6;
    }

    .footer-contact-item:hover {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
    }

    .footer-contact-item i {
        transition: transform 0.3s ease;
    }

    .footer-contact-item:hover i {
        transform: scale(1.2);
    }

    .hero-image:hover {
        transform: rotate(2deg) scale(1.03);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .container-wide {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .tab-group {
            flex-direction: column;
        }

        .tab-item {
            min-width: 100%;
        }

        .dosen-header {
            padding: 1.5rem;
        }

        .hero-content {
            text-align: center;
        }

        .stat-badge {
            margin-bottom: 0.5rem;
        }

        .search-container {
            padding: 0 1rem;
        }

        .search-form {
            padding: 1.5rem;
        }
    }
</style>

<body class="min-h-screen flex flex-col">
    <div class="content-wrapper">
        <header class="gradient-bg text-white shadow-xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-blue-300 opacity-20"></div>
                <div class="absolute top-40 right-20 w-24 h-24 rounded-full bg-blue-200 opacity-15"></div>
                <div class="absolute bottom-10 left-1/4 w-32 h-32 rounded-full bg-blue-300 opacity-10"></div>
            </div>

            <div class="container-wide py-6 relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center mb-4 md:mb-0">
                        <img src="{{ asset('images/logo/unima-logo.png') }}" alt="Logo UNIMA"
                            class="h-20 w-auto md:h-24 mr-4 filter drop-shadow-xl hover:scale-105 transition-transform">
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold flex items-center">
                                <span>Repositori Dosen</span>
                                <span class="ml-2 text-yellow-400 text-lg hover:rotate-12 transition-transform"><i
                                        class="fas fa-star"></i></span>
                            </h1>
                            <p class="text-yellow-300 font-medium flex items-center">
                                <i class="fas fa-university mr-2 hover:text-yellow-200 transition-colors"></i>Teknik
                                Informatika - Universitas Negeri Manado
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="main-content">
            <div class="hero-pattern py-12 relative overflow-hidden">
                <div class="absolute top-10 right-10 opacity-10">
                    <i
                        class="fas fa-atom text-[200px] text-blue-500 hover:rotate-180 transition-transform duration-1000"></i>
                </div>

                <div class="container-wide relative z-10">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-10 md:mb-0 text-center md:text-left hero-content">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
                                Temukan Dosen & Karya Inovasi
                                <span class="text-blue-600 hover:text-blue-800 transition-colors">Teknik
                                    Informatika</span>
                            </h1>
                            <p class="text-gray-600 mb-6 max-w-xl">
                                Jelajahi profil dosen, penelitian, pengabdian, dan karya inovatif
                                Program Studi Teknik Informatika Universitas Negeri Manado
                            </p>
                            <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                                <a href="{{ route('public.category', ['category' => 'dosens']) }}"
                                    class="stat-badge clickable">
                                    <i class="fas fa-users mr-2"></i> {{ isset($totalDosens) ? $totalDosens : 0 }} Dosen
                                </a>
                                <a href="{{ route('public.category', ['category' => 'penelitians']) }}"
                                    class="stat-badge clickable">
                                    <i class="fas fa-flask mr-2"></i>
                                    {{ isset($totalPenelitians) ? $totalPenelitians : 0 }} Penelitian
                                </a>
                                <a href="{{ route('public.category', ['category' => 'pengabdians']) }}"
                                    class="stat-badge clickable">
                                    <i class="fas fa-hands-helping mr-2"></i>
                                    {{ isset($totalPengabdians) ? $totalPengabdians : 0 }} Pengabdian
                                </a>
                                <a href="{{ route('public.category', ['category' => 'hakis']) }}"
                                    class="stat-badge clickable">
                                    <i class="fas fa-copyright mr-2"></i> {{ isset($totalHakis) ? $totalHakis : 0 }}
                                    HAKI
                                </a>
                                <a href="{{ route('public.category', ['category' => 'patens']) }}"
                                    class="stat-badge clickable">
                                    <i class="fas fa-book mr-2"></i> {{ isset($totalPatens) ? $totalPatens : 0 }} Paten
                                </a>
                            </div>
                        </div>

                        <div class="md:w-1/2 flex justify-center">
                            <div class="relative">
                                <div class="floating">
                                    <img src="https://cdn.pixabay.com/photo/2018/03/10/12/00/teamwork-3213924_1280.jpg"
                                        alt="Teamwork"
                                        class="w-72 h-72 object-cover rounded-xl shadow-xl border-8 border-white hero-image transition-all duration-300">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-8">
                <div class="search-container">
                    <div class="bg-white search-card-wide">
                        <div class="gradient-bg text-white p-6">
                            <h2 class="text-xl md:text-2xl font-bold flex items-center">
                                <i class="fas fa-search mr-3 hover:rotate-12 transition-transform"></i> Pencarian Dosen
                            </h2>
                            <p class="opacity-90">Cari dosen berdasarkan nama, NIDN</p>
                        </div>

                        <div class="search-form">
                            <form action="{{ route('public.search') }}" method="POST">
                                @csrf
                                <div class="mb-6">
                                    <div class="relative">
                                        <input type="text" name="query" value="{{ old('query', $query ?? '') }}"
                                            placeholder="Contoh: Dr. Audy Kenap, atau 1234567890"
                                            class="search-input w-full p-4 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    @error('query')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site') }}">
                                    </div>
                                    @error('g-recaptcha-response')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full gradient-bg hover:opacity-90 text-white p-4 rounded-xl text-base font-bold transition-all duration-300 flex items-center justify-center glow-hover">
                                    <i class="fas fa-search mr-3"></i> Cari Dosen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-wide py-8 section-spacing">
                <div class="card-container">
                    @if (isset($categoryData))
                        <div class="space-y-6">
                            @if ($category === 'dosens')
                                @foreach ($categoryData as $dosen)
                                    <div class="bg-white rounded-2xl card-shadow overflow-hidden animate-fade-in dosen-card"
                                        data-dosen-id="{{ $dosen->id }}">
                                        <div class="gradient-bg text-white p-6 md:p-8 relative overflow-hidden dosen-header">
                                            <div class="absolute top-0 right-0 opacity-20">
                                                <i
                                                    class="fas fa-atom text-[180px] text-blue-500 hover:rotate-180 transition-transform duration-1000"></i>
                                            </div>

                                            <div class="flex flex-col md:flex-row items-center relative z-10">
                                                <div class="mb-6 md:mb-0 md:mr-8">
                                                    <div
                                                        class="w-24 h-24 md:w-32 md:h-32 bg-gray-200 rounded-full overflow-hidden profile-border">
                                                        <img src="{{ $dosen->foto ? Storage::url($dosen->foto) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80' }}"
                                                            alt="Foto Dosen {{ $dosen->nama }}" class="w-full h-full object-cover">
                                                    </div>
                                                </div>
                                                <div class="text-center md:text-left">
                                                    <h2
                                                        class="text-2xl md:text-3xl font-bold hover:text-blue-200 transition-colors">
                                                        {{ $dosen->nama }}
                                                    </h2>
                                                    <p class="text-blue-200 mt-2">
                                                        <i class="fas fa-user-tie mr-2"></i>
                                                        {{ $dosen->jabatan_akademik ?? 'Dosen Teknik Informatika' }}
                                                    </p>
                                                    <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                                                        <div
                                                            class="bg-blue-500/30 backdrop-blur px-3 py-1.5 rounded-full text-sm hover:bg-blue-600 transition-colors">
                                                            <i class="fas fa-id-card mr-2"></i> NIDN: {{ $dosen->nidn ?? '-' }}
                                                        </div>
                                                        <div
                                                            class="bg-blue-500/30 backdrop-blur px-3 py-1.5 rounded-full text-sm hover:bg-blue-600 transition-colors">
                                                            <i class="fas fa-fingerprint mr-2"></i> NIP: {{ $dosen->nip ?? '-' }}
                                                        </div>
                                                        <div
                                                            class="bg-blue-500/30 backdrop-blur px-3 py-1.5 rounded-full text-sm hover:bg-blue-600 transition-colors">
                                                            <i class="fas fa-id-badge mr-2"></i> NUPTK: {{ $dosen->nuptk ?? '-' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-b border-gray-200 bg-white">
                                            <ul class="flex flex-wrap tab-group">
                                                <li class="tab-item">
                                                    <a class="portfolio-tab tab-link tab-active"
                                                        data-tab="penelitian-{{ $dosen->id }}">
                                                        <div class="tab-icon text-blue-600">
                                                            <i class="fas fa-flask"></i>
                                                        </div>
                                                        <div class="tab-title">Penelitian</div>
                                                        <div class="tab-count">{{ $dosen->penelitians->count() }}</div>
                                                    </a>
                                                </li>
                                                <li class="tab-item">
                                                    <a class="portfolio-tab tab-link" data-tab="pengabdian-{{ $dosen->id }}">
                                                        <div class="tab-icon text-green-600">
                                                            <i class="fas fa-hands-helping"></i>
                                                        </div>
                                                        <div class="tab-title">Pengabdian</div>
                                                        <div class="tab-count">{{ $dosen->pengabdians->count() }}</div>
                                                    </a>
                                                </li>
                                                <li class="tab-item">
                                                    <a class="portfolio-tab tab-link" data-tab="haki-{{ $dosen->id }}">
                                                        <div class="tab-icon text-purple-600">
                                                            <i class="fas fa-copyright"></i>
                                                        </div>
                                                        <div class="tab-title">HAKI</div>
                                                        <div class="tab-count">{{ $dosen->hakis->count() }}</div>
                                                    </a>
                                                </li>
                                                <li class="tab-item">
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

                                        <div class="portfolio-section dosen-content">
                                            <!-- Penelitian -->
                                            <div id="penelitian-{{ $dosen->id }}" class="tab-content">
                                                <div class="mb-6">
                                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                                        <i
                                                            class="fas fa-flask text-blue-600 mr-2 hover:rotate-12 transition-transform"></i>
                                                        Penelitian Dosen
                                                    </h3>
                                                    <div class="flex flex-wrap gap-4 mb-4">
                                                        <a href="#"
                                                            class="portfolio-tab tab-link {{ !request()->has('skema') || request()->skema == 'all' ? 'tab-active' : '' }}"
                                                            data-tab="penelitian-{{ $dosen->id }}-all" data-skema="all">
                                                            <div class="tab-title">Semua</div>
                                                            <div class="tab-count">{{ $dosen->penelitians->count() }}</div>
                                                        </a>
                                                        <a href="#"
                                                            class="portfolio-tab tab-link {{ request()->skema == 'drtpm' ? 'tab-active' : '' }}"
                                                            data-tab="penelitian-{{ $dosen->id }}-drtpm" data-skema="drtpm">
                                                            <div class="tab-title">DRTPM</div>
                                                            <div class="tab-count">
                                                                {{ $dosen->penelitians->where('skema', 'drtpm')->count() }}
                                                            </div>
                                                        </a>
                                                        <a href="#"
                                                            class="portfolio-tab tab-link {{ request()->skema == 'internal' ? 'tab-active' : '' }}"
                                                            data-tab="penelitian-{{ $dosen->id }}-internal" data-skema="internal">
                                                            <div class="tab-title">Pendanaan Internal</div>
                                                            <div class="tab-count">
                                                                {{ $dosen->penelitians->where('skema', 'internal')->count() }}
                                                            </div>
                                                        </a>
                                                        <a href="#"
                                                            class="portfolio-tab tab-link {{ request()->skema == 'hibah' ? 'tab-active' : '' }}"
                                                            data-tab="penelitian-{{ $dosen->id }}-hibah" data-skema="hibah">
                                                            <div class="tab-title">Pendanaan Hibah</div>
                                                            <div class="tab-count">
                                                                {{ $dosen->penelitians->where('skema', 'hibah')->count() }}
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="portfolio-table w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="w-4/12">Judul Penelitian</th>
                                                                <th>Skema</th>
                                                                <th>Tahun</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="dosen-data" data-type="penelitian" data-id="{{ $dosen->id }}">
                                                            @foreach ($dosen->penelitians as $penelitian)
                                                                <tr>
                                                                    <td
                                                                        class="font-medium hover:text-blue-600 transition-colors cursor-pointer">
                                                                        {{ $penelitian->judul_penelitian }}
                                                                    </td>
                                                                    <td>{{ ucfirst($penelitian->skema) }}</td>
                                                                    <td>{{ $penelitian->tahun }}</td>
                                                                    <td>
                                                                        @if($penelitian->status === 'Selesai')
                                                                            <span class="status-badge status-active">
                                                                                <i
                                                                                    class="fas fa-check-circle mr-1"></i>{{ $penelitian->status }}
                                                                            </span>
                                                                        @else
                                                                            <span class="status-badge status-pending">
                                                                                <i class="fas fa-spinner mr-1"></i>{{ $penelitian->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @if ($dosen->penelitians->isEmpty())
                                                                <tr>
                                                                    <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada
                                                                        data penelitian untuk kategori ini.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Pengabdian -->
                                            <div id="pengabdian-{{ $dosen->id }}" class="tab-content hidden">
                                                <div class="mb-6">
                                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                                        <i
                                                            class="fas fa-hands-helping text-green-600 mr-2 hover:rotate-12 transition-transform"></i>
                                                        Pengabdian Masyarakat
                                                    </h3>
                                                    <div class="flex flex-wrap gap-4 mb-4">
                                                        <a href="#"
                                                            class="portfolio-tab tab-link {{ !request()->has('skema') || request()->skema == 'all' ? 'tab-active' : '' }}"
                                                            data-tab="pengabdian-{{ $dosen->id }}-all" data-skema="all">
                                                            <div class="tab-title">Semua</div>
                                                            <div class="tab-count">{{ $dosen->pengabdians->count() }}</div>
                                                        </a>
                                                        <a href="#"
                                                            class="portfolio-tab tab-link {{ request()->skema == 'drtpm' ? 'tab-active' : '' }}"
                                                            data-tab="pengabdian-{{ $dosen->id }}-drtpm" data-skema="drtpm">
                                                            <div class="tab-title">DRTPM</div>
                                                            <div class="tab-count">
                                                                {{ $dosen->pengabdians->where('skema', 'drtpm')->count() }}
                                                            </div>
                                                        </a>
                                                        <a href="#"
                                                            class="portfolio-tab tab-link {{ request()->skema == 'internal' ? 'tab-active' : '' }}"
                                                            data-tab="pengabdian-{{ $dosen->id }}-internal" data-skema="internal">
                                                            <div class="tab-title">Pendanaan Internal</div>
                                                            <div class="tab-count">
                                                                {{ $dosen->pengabdians->where('skema', 'internal')->count() }}
                                                            </div>
                                                        </a>
                                                        <a href="#"
                                                            class="portfolio-tab tab-link {{ request()->skema == 'hibah' ? 'tab-active' : '' }}"
                                                            data-tab="pengabdian-{{ $dosen->id }}-hibah" data-skema="hibah">
                                                            <div class="tab-title">Pendanaan Hibah</div>
                                                            <div class="tab-count">
                                                                {{ $dosen->pengabdians->where('skema', 'hibah')->count() }}
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="portfolio-table w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="w-4/12">Judul Pengabdian</th>
                                                                <th>Skema</th>
                                                                <th>Tahun</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="dosen-data" data-type="pengabdian" data-id="{{ $dosen->id }}">
                                                            @foreach ($dosen->pengabdians as $pengabdian)
                                                                <tr>
                                                                    <td
                                                                        class="font-medium hover:text-green-600 transition-colors cursor-pointer">
                                                                        {{ $pengabdian->judul_pengabdian }}
                                                                    </td>
                                                                    <td>{{ ucfirst($pengabdian->skema) }}</td>
                                                                    <td>{{ $pengabdian->tahun }}</td>
                                                                    <td>
                                                                        @if($pengabdian->status === 'Selesai')
                                                                            <span class="status-badge status-active">
                                                                                <i
                                                                                    class="fas fa-check-circle mr-1"></i>{{ $pengabdian->status }}
                                                                            </span>
                                                                        @else
                                                                            <span class="status-badge status-pending">
                                                                                <i class="fas fa-spinner mr-1"></i>{{ $pengabdian->status }}
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            @if ($dosen->pengabdians->isEmpty())
                                                                <tr>
                                                                    <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada
                                                                        data pengabdian untuk kategori ini.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- HAKI -->
                                            <div id="haki-{{ $dosen->id }}" class="tab-content hidden">
                                                <div class="mb-6">
                                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                                        <i
                                                            class="fas fa-copyright text-purple-600 mr-2 hover:rotate-12 transition-transform"></i>
                                                        Hak Kekayaan Intelektual
                                                    </h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="portfolio-table w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="w-4/12">Judul HAKI</th>
                                                                <th>Expired</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="dosen-data" data-type="haki" data-id="{{ $dosen->id }}">
                                                            @foreach ($dosen->hakis as $haki)
                                                                <tr>
                                                                    <td
                                                                        class="font-medium hover:text-purple-600 transition-colors cursor-pointer">
                                                                        {{ $haki->judul_haki }}
                                                                    </td>
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
                                                            @if ($dosen->hakis->isEmpty())
                                                                <tr>
                                                                    <td colspan="3" class="text-center py-4 text-gray-600">Tidak ada
                                                                        data HAKI.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Paten -->
                                            <div id="paten-{{ $dosen->id }}" class="tab-content hidden">
                                                <div class="mb-6">
                                                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                                        <i
                                                            class="fas fa-file-certificate text-yellow-600 mr-2 hover:rotate-12 transition-transform"></i>
                                                        Paten dan Inovasi
                                                    </h3>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="portfolio-table w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="w-4/12">Judul Paten</th>
                                                                <th>Jenis Paten</th>
                                                                <th>Expired</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="dosen-data" data-type="paten" data-id="{{ $dosen->id }}">
                                                            @foreach ($dosen->patens as $paten)
                                                                <tr>
                                                                    <td
                                                                        class="font-medium hover:text-yellow-600 transition-colors cursor-pointer">
                                                                        {{ $paten->judul_paten }}
                                                                    </td>
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
                                                            @if ($dosen->patens->isEmpty())
                                                                <tr>
                                                                    <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada
                                                                        data paten.</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif ($category === 'penelitians')
                                <div class="bg-white rounded-2xl card-shadow overflow-hidden animate-fade-in">
                                    <div class="gradient-bg text-white p-6">
                                        <h2 class="text-xl md:text-2xl font-bold flex items-center">
                                            <i class="fas fa-flask mr-3 hover:rotate-12 transition-transform"></i>
                                            {{ $categoryTitle }}
                                        </h2>
                                    </div>
                                    <div class="p-6">
                                        <div class="skema-filter">
                                            <a href="{{ route('public.category', ['category' => 'penelitians', 'skema' => 'all']) }}"
                                                class="{{ $skema === 'all' ? 'tab-active text-blue-600' : '' }}"
                                                data-skema="all">
                                                <div class="tab-title">Semua</div>
                                                <div class="tab-count">{{ $categoryData->count() }}</div>
                                            </a>
                                            <a href="{{ route('public.category', ['category' => 'penelitians', 'skema' => 'drtpm']) }}"
                                                class="{{ $skema === 'drtpm' ? 'tab-active text-blue-600' : '' }}"
                                                data-skema="drtpm">
                                                <div class="tab-title">DRTPM</div>
                                                <div class="tab-count">{{ $categoryData->where('skema', 'drtpm')->count() }}
                                                </div>
                                            </a>
                                            <a href="{{ route('public.category', ['category' => 'penelitians', 'skema' => 'internal']) }}"
                                                class="{{ $skema === 'internal' ? 'tab-active text-blue-600' : '' }}"
                                                data-skema="internal">
                                                <div class="tab-title">Pendanaan Internal</div>
                                                <div class="tab-count">{{ $categoryData->where('skema', 'internal')->count() }}
                                                </div>
                                            </a>
                                            <a href="{{ route('public.category', ['category' => 'penelitians', 'skema' => 'hibah']) }}"
                                                class="{{ $skema === 'hibah' ? 'tab-active text-blue-600' : '' }}"
                                                data-skema="hibah">
                                                <div class="tab-title">Pendanaan Hibah</div>
                                                <div class="tab-count">{{ $categoryData->where('skema', 'hibah')->count() }}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="portfolio-table w-full">
                                                <thead>
                                                    <tr>
                                                        <th class="w-4/12">Judul Penelitian</th>
                                                        <th>Dosen</th>
                                                        <th>Skema</th>
                                                        <th>Tahun</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="category-data" data-type="penelitian">
                                                    @foreach ($categoryData as $penelitian)
                                                        <tr>
                                                            <td
                                                                class="font-medium hover:text-blue-600 transition-colors cursor-pointer">
                                                                {{ $penelitian->judul_penelitian }}
                                                            </td>
                                                            <td class="hover:font-medium transition-all">
                                                                {{ $penelitian->dosen->nama }}
                                                            </td>
                                                            <td>{{ ucfirst($penelitian->skema) }}</td>
                                                            <td>{{ $penelitian->tahun }}</td>
                                                            <td>
                                                                @if($penelitian->status === 'Selesai')
                                                                    <span class="status-badge status-active">
                                                                        <i
                                                                            class="fas fa-check-circle mr-1"></i>{{ $penelitian->status }}
                                                                    </span>
                                                                @else
                                                                    <span class="status-badge status-pending">
                                                                        <i class="fas fa-spinner mr-1"></i>{{ $penelitian->status }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @if ($categoryData->isEmpty())
                                                        <tr>
                                                            <td colspan="5" class="text-center py-4 text-gray-600">Tidak ada
                                                                data penelitian.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($category === 'pengabdians')
                                <div class="bg-white rounded-2xl card-shadow overflow-hidden animate-fade-in">
                                    <div class="gradient-bg text-white p-6">
                                        <h2 class="text-xl md:text-2xl font-bold flex items-center">
                                            <i class="fas fa-hands-helping mr-3 hover:rotate-12 transition-transform"></i>
                                            {{ $categoryTitle }}
                                        </h2>
                                    </div>
                                    <div class="p-6">
                                        <div class="skema-filter">
                                            <a href="{{ route('public.category', ['category' => 'pengabdians', 'skema' => 'all']) }}"
                                                class="{{ $skema === 'all' ? 'tab-active text-green-600' : '' }}"
                                                data-skema="all">
                                                <div class="tab-title">Semua</div>
                                                <div class="tab-count">{{ $categoryData->count() }}</div>
                                            </a>
                                            <a href="{{ route('public.category', ['category' => 'pengabdians', 'skema' => 'drtpm']) }}"
                                                class="{{ $skema === 'drtpm' ? 'tab-active text-green-600' : '' }}"
                                                data-skema="drtpm">
                                                <div class="tab-title">DRTPM</div>
                                                <div class="tab-count">{{ $categoryData->where('skema', 'drtpm')->count() }}
                                                </div>
                                            </a>
                                            <a href="{{ route('public.category', ['category' => 'pengabdians', 'skema' => 'internal']) }}"
                                                class="{{ $skema === 'internal' ? 'tab-active text-green-600' : '' }}"
                                                data-skema="internal">
                                                <div class="tab-title">Pendanaan Internal</div>
                                                <div class="tab-count">{{ $categoryData->where('skema', 'internal')->count() }}
                                                </div>
                                            </a>
                                            <a href="{{ route('public.category', ['category' => 'pengabdians', 'skema' => 'hibah']) }}"
                                                class="{{ $skema === 'hibah' ? 'tab-active text-green-600' : '' }}"
                                                data-skema="hibah">
                                                <div class="tab-title">Pendanaan Hibah</div>
                                                <div class="tab-count">{{ $categoryData->where('skema', 'hibah')->count() }}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="portfolio-table w-full">
                                                <thead>
                                                    <tr>
                                                        <th class="w-4/12">Judul Pengabdian</th>
                                                        <th>Dosen</th>
                                                        <th>Skema</th>
                                                        <th>Tahun</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="category-data" data-type="pengabdian">
                                                    @foreach ($categoryData as $pengabdian)
                                                        <tr>
                                                            <td
                                                                class="font-medium hover:text-green-600 transition-colors cursor-pointer">
                                                                {{ $pengabdian->judul_pengabdian }}
                                                            </td>
                                                            <td class="hover:font-medium transition-all">
                                                                {{ $pengabdian->dosen->nama }}
                                                            </td>
                                                            <td>{{ ucfirst($pengabdian->skema) }}</td>
                                                            <td>{{ $pengabdian->tahun }}</td>
                                                            <td>
                                                                @if($pengabdian->status === 'Selesai')
                                                                    <span class="status-badge status-active">
                                                                        <i
                                                                            class="fas fa-check-circle mr-1"></i>{{ $pengabdian->status }}
                                                                    </span>
                                                                @else
                                                                    <span class="status-badge status-pending">
                                                                        <i class="fas fa-spinner mr-1"></i>{{ $pengabdian->status }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @if ($categoryData->isEmpty())
                                                        <tr>
                                                            <td colspan="5" class="text-center py-4 text-gray-600">Tidak ada
                                                                data pengabdian.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($category === 'hakis')
                                <div class="bg-white rounded-2xl card-shadow overflow-hidden animate-fade-in">
                                    <div class="gradient-bg text-white p-6">
                                        <h2 class="text-xl md:text-2xl font-bold flex items-center">
                                            <i class="fas fa-copyright mr-3 hover:rotate-12 transition-transform"></i>
                                            {{ $categoryTitle }}
                                        </h2>
                                    </div>
                                    <div class="p-6">
                                        <div class="table-responsive">
                                            <table class="portfolio-table w-full">
                                                <thead>
                                                    <tr>
                                                        <th class="w-4/12">Judul HAKI</th>
                                                        <th>Dosen</th>
                                                        <th>Expired</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="category-data" data-type="haki">
                                                    @foreach ($categoryData as $haki)
                                                        <tr>
                                                            <td
                                                                class="font-medium hover:text-purple-600 transition-colors cursor-pointer">
                                                                {{ $haki->judul_haki }}
                                                            </td>
                                                            <td class="hover:font-medium transition-all">{{ $haki->dosen->nama }}
                                                            </td>
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
                                                    @if ($categoryData->isEmpty())
                                                        <tr>
                                                            <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada
                                                                data HAKI.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($category === 'patens')
                                <div class="bg-white rounded-2xl card-shadow overflow-hidden animate-fade-in">
                                    <div class="gradient-bg text-white p-6">
                                        <h2 class="text-xl md:text-2xl font-bold flex items-center">
                                            <i class="fas fa-book mr-3 hover:rotate-12 transition-transform"></i>
                                            {{ $categoryTitle }}
                                        </h2>
                                    </div>
                                    <div class="p-6">
                                        <div class="table-responsive">
                                            <table class="portfolio-table w-full">
                                                <thead>
                                                    <tr>
                                                        <th class="w-4/12">Judul Paten</th>
                                                        <th>Dosen</th>
                                                        <th>Jenis Paten</th>
                                                        <th>Expired</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="category-data" data-type="paten">
                                                    @foreach ($categoryData as $paten)
                                                        <tr>
                                                            <td
                                                                class="font-medium hover:text-yellow-600 transition-colors cursor-pointer">
                                                                {{ $paten->judul_paten }}
                                                            </td>
                                                            <td class="hover:font-medium transition-all">{{ $paten->dosen->nama }}
                                                            </td>
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
                                                    @if ($categoryData->isEmpty())
                                                        <tr>
                                                            <td colspan="5" class="text-center py-4 text-gray-600">Tidak ada
                                                                data paten.</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @elseif (isset($dosens) && $dosens->count() > 0)
                        <div class="space-y-6">
                            @foreach ($dosens as $dosen)
                                <div class="bg-white rounded-2xl card-shadow overflow-hidden animate-fade-in dosen-card"
                                    data-dosen-id="{{ $dosen->id }}">
                                    <div class="gradient-bg text-white p-6 md:p-8 relative overflow-hidden dosen-header">
                                        <div class="absolute top-0 right-0 opacity-20">
                                            <i
                                                class="fas fa-atom text-[180px] text-blue-500 hover:rotate-180 transition-transform duration-1000"></i>
                                        </div>

                                        <div class="flex flex-col md:flex-row items-center relative z-10">
                                            <div class="mb-6 md:mb-0 md:mr-8">
                                                <div
                                                    class="w-24 h-24 md:w-32 md:h-32 bg-gray-200 rounded-full overflow-hidden profile-border">
                                                    <img src="{{ $dosen->foto ? Storage::url($dosen->foto) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80' }}"
                                                        alt="Foto Dosen {{ $dosen->nama }}" class="w-full h-full object-cover">
                                                </div>
                                            </div>
                                            <div class="text-center md:text-left">
                                                <h2
                                                    class="text-2xl md:text-3xl font-bold hover:text-blue-200 transition-colors">
                                                    {{ $dosen->nama }}
                                                </h2>
                                                <p class="text-blue-200 mt-2">
                                                    <i class="fas fa-user-tie mr-2"></i>
                                                    {{ $dosen->jabatan_akademik ?? 'Dosen Teknik Informatika' }}
                                                </p>
                                                <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                                                    <div
                                                        class="bg-blue-500/30 backdrop-blur px-3 py-1.5 rounded-full text-sm hover:bg-blue-600 transition-colors">
                                                        <i class="fas fa-id-card mr-2"></i> NIDN: {{ $dosen->nidn ?? '-' }}
                                                    </div>
                                                    <div
                                                        class="bg-blue-500/30 backdrop-blur px-3 py-1.5 rounded-full text-sm hover:bg-blue-600 transition-colors">
                                                        <i class="fas fa-fingerprint mr-2"></i> NIP: {{ $dosen->nip ?? '-' }}
                                                    </div>
                                                    <div
                                                        class="bg-blue-500/30 backdrop-blur px-3 py-1.5 rounded-full text-sm hover:bg-blue-600 transition-colors">
                                                        <i class="fas fa-id-badge mr-2"></i> NUPTK: {{ $dosen->nuptk ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border-b border-gray-200 bg-white">
                                        <ul class="flex flex-wrap tab-group">
                                            <li class="tab-item">
                                                <a class="portfolio-tab tab-link tab-active"
                                                    data-tab="penelitian-{{ $dosen->id }}">
                                                    <div class="tab-icon text-blue-600">
                                                        <i class="fas fa-flask"></i>
                                                    </div>
                                                    <div class="tab-title">Penelitian</div>
                                                    <div class="tab-count">{{ $dosen->penelitians->count() }}</div>
                                                </a>
                                            </li>
                                            <li class="tab-item">
                                                <a class="portfolio-tab tab-link" data-tab="pengabdian-{{ $dosen->id }}">
                                                    <div class="tab-icon text-green-600">
                                                        <i class="fas fa-hands-helping"></i>
                                                    </div>
                                                    <div class="tab-title">Pengabdian</div>
                                                    <div class="tab-count">{{ $dosen->pengabdians->count() }}</div>
                                                </a>
                                            </li>
                                            <li class="tab-item">
                                                <a class="portfolio-tab tab-link" data-tab="haki-{{ $dosen->id }}">
                                                    <div class="tab-icon text-purple-600">
                                                        <i class="fas fa-copyright"></i>
                                                    </div>
                                                    <div class="tab-title">HAKI</div>
                                                    <div class="tab-count">{{ $dosen->hakis->count() }}</div>
                                                </a>
                                            </li>
                                            <li class="tab-item">
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

                                    <div class="portfolio-section dosen-content">
                                        <!-- Penelitian -->
                                        <div id="penelitian-{{ $dosen->id }}" class="tab-content">
                                            <div class="mb-6">
                                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                                    <i
                                                        class="fas fa-flask text-blue-600 mr-2 hover:rotate-12 transition-transform"></i>
                                                    Penelitian Dosen
                                                </h3>
                                                <div class="flex flex-wrap gap-4 mb-4">
                                                    <a href="#"
                                                        class="portfolio-tab tab-link {{ !request()->has('skema') || request()->skema == 'all' ? 'tab-active' : '' }}"
                                                        data-tab="penelitian-{{ $dosen->id }}-all" data-skema="all">
                                                        <div class="tab-title">Semua</div>
                                                        <div class="tab-count">{{ $dosen->penelitians->count() }}</div>
                                                    </a>
                                                    <a href="#"
                                                        class="portfolio-tab tab-link {{ request()->skema == 'drtpm' ? 'tab-active' : '' }}"
                                                        data-tab="penelitian-{{ $dosen->id }}-drtpm" data-skema="drtpm">
                                                        <div class="tab-title">DRTPM</div>
                                                        <div class="tab-count">
                                                            {{ $dosen->penelitians->where('skema', 'drtpm')->count() }}
                                                        </div>
                                                    </a>
                                                    <a href="#"
                                                        class="portfolio-tab tab-link {{ request()->skema == 'internal' ? 'tab-active' : '' }}"
                                                        data-tab="penelitian-{{ $dosen->id }}-internal" data-skema="internal">
                                                        <div class="tab-title">Pendanaan Internal</div>
                                                        <div class="tab-count">
                                                            {{ $dosen->penelitians->where('skema', 'internal')->count() }}
                                                        </div>
                                                    </a>
                                                    <a href="#"
                                                        class="portfolio-tab tab-link {{ request()->skema == 'hibah' ? 'tab-active' : '' }}"
                                                        data-tab="penelitian-{{ $dosen->id }}-hibah" data-skema="hibah">
                                                        <div class="tab-title">Pendanaan Hibah</div>
                                                        <div class="tab-count">
                                                            {{ $dosen->penelitians->where('skema', 'hibah')->count() }}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="portfolio-table w-full">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-4/12">Judul Penelitian</th>
                                                            <th>Skema</th>
                                                            <th>Tahun</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="dosen-data" data-type="penelitian" data-id="{{ $dosen->id }}">
                                                        @foreach ($dosen->penelitians as $penelitian)
                                                            <tr>
                                                                <td
                                                                    class="font-medium hover:text-blue-600 transition-colors cursor-pointer">
                                                                    {{ $penelitian->judul_penelitian }}
                                                                </td>
                                                                <td>{{ ucfirst($penelitian->skema) }}</td>
                                                                <td>{{ $penelitian->tahun }}</td>
                                                                <td>
                                                                    @if($penelitian->status === 'Selesai')
                                                                        <span class="status-badge status-active">
                                                                            <i
                                                                                class="fas fa-check-circle mr-1"></i>{{ $penelitian->status }}
                                                                        </span>
                                                                    @else
                                                                        <span class="status-badge status-pending">
                                                                            <i class="fas fa-spinner mr-1"></i>{{ $penelitian->status }}
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @if ($dosen->penelitians->isEmpty())
                                                            <tr>
                                                                <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada
                                                                    data penelitian untuk kategori ini.</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Pengabdian -->
                                        <div id="pengabdian-{{ $dosen->id }}" class="tab-content hidden">
                                            <div class="mb-6">
                                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                                    <i
                                                        class="fas fa-hands-helping text-green-600 mr-2 hover:rotate-12 transition-transform"></i>
                                                    Pengabdian Masyarakat
                                                </h3>
                                                <div class="flex flex-wrap gap-4 mb-4">
                                                    <a href="#"
                                                        class="portfolio-tab tab-link {{ !request()->has('skema') || request()->skema == 'all' ? 'tab-active' : '' }}"
                                                        data-tab="pengabdian-{{ $dosen->id }}-all" data-skema="all">
                                                        <div class="tab-title">Semua</div>
                                                        <div class="tab-count">{{ $dosen->pengabdians->count() }}</div>
                                                    </a>
                                                    <a href="#"
                                                        class="portfolio-tab tab-link {{ request()->skema == 'drtpm' ? 'tab-active' : '' }}"
                                                        data-tab="pengabdian-{{ $dosen->id }}-drtpm" data-skema="drtpm">
                                                        <div class="tab-title">DRTPM</div>
                                                        <div class="tab-count">
                                                            {{ $dosen->pengabdians->where('skema', 'drtpm')->count() }}
                                                        </div>
                                                    </a>
                                                    <a href="#"
                                                        class="portfolio-tab tab-link {{ request()->skema == 'internal' ? 'tab-active' : '' }}"
                                                        data-tab="pengabdian-{{ $dosen->id }}-internal" data-skema="internal">
                                                        <div class="tab-title">Pendanaan Internal</div>
                                                        <div class="tab-count">
                                                            {{ $dosen->pengabdians->where('skema', 'internal')->count() }}
                                                        </div>
                                                    </a>
                                                    <a href="#"
                                                        class="portfolio-tab tab-link {{ request()->skema == 'hibah' ? 'tab-active' : '' }}"
                                                        data-tab="pengabdian-{{ $dosen->id }}-hibah" data-skema="hibah">
                                                        <div class="tab-title">Pendanaan Hibah</div>
                                                        <div class="tab-count">
                                                            {{ $dosen->pengabdians->where('skema', 'hibah')->count() }}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="portfolio-table w-full">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-4/12">Judul Pengabdian</th>
                                                            <th>Skema</th>
                                                            <th>Tahun</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="dosen-data" data-type="pengabdian" data-id="{{ $dosen->id }}">
                                                        @foreach ($dosen->pengabdians as $pengabdian)
                                                            <tr>
                                                                <td
                                                                    class="font-medium hover:text-green-600 transition-colors cursor-pointer">
                                                                    {{ $pengabdian->judul_pengabdian }}
                                                                </td>
                                                                <td>{{ ucfirst($pengabdian->skema) }}</td>
                                                                <td>{{ $pengabdian->tahun }}</td>
                                                                <td>
                                                                    @if($pengabdian->status === 'Selesai')
                                                                        <span class="status-badge status-active">
                                                                            <i
                                                                                class="fas fa-check-circle mr-1"></i>{{ $pengabdian->status }}
                                                                        </span>
                                                                    @else
                                                                        <span class="status-badge status-pending">
                                                                            <i class="fas fa-spinner mr-1"></i>{{ $pengabdian->status }}
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        @if ($dosen->pengabdians->isEmpty())
                                                            <tr>
                                                                <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada
                                                                    data pengabdian untuk kategori ini.</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- HAKI -->
                                        <div id="haki-{{ $dosen->id }}" class="tab-content hidden">
                                            <div class="mb-6">
                                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                                    <i
                                                        class="fas fa-copyright text-purple-600 mr-2 hover:rotate-12 transition-transform"></i>
                                                    Hak Kekayaan Intelektual
                                                </h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="portfolio-table w-full">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-4/12">Judul HAKI</th>
                                                            <th>Expired</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="dosen-data" data-type="haki" data-id="{{ $dosen->id }}">
                                                        @foreach ($dosen->hakis as $haki)
                                                            <tr>
                                                                <td
                                                                    class="font-medium hover:text-purple-600 transition-colors cursor-pointer">
                                                                    {{ $haki->judul_haki }}
                                                                </td>
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
                                                        @if ($dosen->hakis->isEmpty())
                                                            <tr>
                                                                <td colspan="3" class="text-center py-4 text-gray-600">Tidak ada
                                                                    data HAKI.</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Paten -->
                                        <div id="paten-{{ $dosen->id }}" class="tab-content hidden">
                                            <div class="mb-6">
                                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                                    <i
                                                        class="fas fa-file-certificate text-yellow-600 mr-2 hover:rotate-12 transition-transform"></i>
                                                    Paten dan Inovasi
                                                </h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="portfolio-table w-full">
                                                    <thead>
                                                        <tr>
                                                            <th class="w-4/12">Judul Paten</th>
                                                            <th>Jenis Paten</th>
                                                            <th>Expired</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="dosen-data" data-type="paten" data-id="{{ $dosen->id }}">
                                                        @foreach ($dosen->patens as $paten)
                                                            <tr>
                                                                <td
                                                                    class="font-medium hover:text-yellow-600 transition-colors cursor-pointer">
                                                                    {{ $paten->judul_paten }}
                                                                </td>
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
                                                        @if ($dosen->patens->isEmpty())
                                                            <tr>
                                                                <td colspan="4" class="text-center py-4 text-gray-600">Tidak ada
                                                                    data paten.</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
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
                                <i class="fas fa-lightbulb mr-2"></i>Tips: Gunakan hanya nama depan atau NIDN untuk hasil
                                lebih akurat
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>

        <footer class="bg-gray-900 text-white py-12 footer-container">
    <div class="container-wide">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <div class="bg-blue-600 p-2 rounded-lg mr-3 hover:rotate-12 transition-transform">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    Repositori Dosen
                </h3>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Sistem informasi repositori dosen Program Studi Teknik Informatika
                    Universitas Negeri Manado untuk mendukung transparansi dan akuntabilitas akademik.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 social-icon">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-400 social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 social-icon">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="text-gray-400 social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="md:col-span-1">
                <h3 class="text-xl font-bold mb-6">Kontak Kami</h3>
                <ul class="space-y-3">
                    <li class="flex items-center footer-contact-item">
                        <i class="fas fa-map-marker-alt mr-3 text-blue-400"></i>
                        <span class="text-gray-400">Kampus Unima, Tondano, Sulawesi Utara, Indonesia</span>
                    </li>
                    <li class="flex items-center footer-contact-item">
                        <i class="fas fa-envelope mr-3 text-blue-400"></i>
                        <span class="text-gray-400">info@unima.ac.id</span>
                    </li>
                    <li class="flex items-center footer-contact-item">
                        <i class="fas fa-phone mr-3 text-blue-400"></i>
                        <span class="text-gray-400">+62 431 123456</span>
                    </li>
                </ul>
            </div>
            <div class="md:col-span-1">
                <h3 class="text-xl font-bold mb-6">Navigasi</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('public.index') }}" class="footer-link text-gray-400 hover:text-blue-300">
                            <i class="fas fa-home mr-2"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('public.category', ['category' => 'dosens']) }}"
                            class="footer-link text-gray-400 hover:text-blue-300">
                            <i class="fas fa-users mr-2"></i> Dosen
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('public.category', ['category' => 'penelitians']) }}"
                            class="footer-link text-gray-400 hover:text-blue-300">
                            <i class="fas fa-flask mr-2"></i> Penelitian
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('public.category', ['category' => 'pengabdians']) }}"
                            class="footer-link text-gray-400 hover:text-blue-300">
                            <i class="fas fa-hands-helping mr-2"></i> Pengabdian
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('public.category', ['category' => 'hakis']) }}"
                            class="footer-link text-gray-400 hover:text-blue-300">
                            <i class="fas fa-copyright mr-2"></i> HAKI
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('public.category', ['category' => 'patens']) }}"
                            class="footer-link text-gray-400 hover:text-blue-300">
                            <i class="fas fa-book mr-2"></i> Paten
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-12 pt-6 border-t border-gray-800 text-center text-gray-500">
            <p>&copy; 2025 Universitas Negeri Manado. Semua hak cipta dilindungi.</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tab functionality
        $('.tab-link').on('click', function(e) {
            e.preventDefault();
            const tabId = $(this).data('tab');
            const dosenId = $(this).closest('.dosen-card').data('dosen-id');
            const skema = $(this).data('skema');

            $(this).closest('.tab-group').find('.tab-active').removeClass('tab-active');
            $(this).addClass('tab-active');

            $(this).closest('.dosen-card').find('.tab-content').addClass('hidden');
            $(`#${tabId}`).removeClass('hidden');

            if (skema) {
                const url = new URL(window.location);
                url.searchParams.set('skema', skema);
                window.history.pushState({}, '', url);
                loadCategoryData(dosenId, tabId.split('-')[0], skema);
            }
        });

        // Load initial category data if skema is set
        const urlParams = new URLSearchParams(window.location.search);
        const initialSkema = urlParams.get('skema');
        if (initialSkema) {
            $('.dosen-card').each(function() {
                const dosenId = $(this).data('dosen-id');
                const tabId = $(`[data-tab="${initialSkema}-${dosenId}"]`).data('tab');
                if (tabId) {
                    $(this).find('.tab-link').removeClass('tab-active');
                    $(`[data-tab="${tabId}"]`).addClass('tab-active');
                    $(this).find('.tab-content').addClass('hidden');
                    $(`#${tabId}`).removeClass('hidden');
                    loadCategoryData(dosenId, tabId.split('-')[0], initialSkema);
                }
            });
        }

        function loadCategoryData(dosenId, type, skema) {
            $.ajax({
                url: `/api/dosen/${dosenId}/${type}`,
                data: { skema: skema },
                success: function(response) {
                    const tbody = $(`.dosen-data[data-type="${type}"][data-id="${dosenId}"]`);
                    tbody.empty();
                    if (response.data.length > 0) {
                        response.data.forEach(item => {
                            let statusBadge = '';
                            if (type === 'penelitian' || type === 'pengabdian') {
                                statusBadge = item.status === 'Selesai' ?
                                    `<span class="status-badge status-active"><i class="fas fa-check-circle mr-1"></i>${item.status}</span>` :
                                    `<span class="status-badge status-pending"><i class="fas fa-spinner mr-1"></i>${item.status}</span>`;
                            } else if (type === 'haki' || type === 'paten') {
                                const expired = item.expired ? new Date(item.expired).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-';
                                statusBadge = item.expired && new Date(item.expired) > new Date() ?
                                    `<span class="status-badge status-active"><i class="fas fa-check-circle mr-1"></i>Aktif</span>` :
                                    `<span class="status-badge status-expired"><i class="fas fa-exclamation-triangle mr-1"></i>Kadaluarsa</span>`;
                                tbody.append(`
                                    <tr>
                                        <td class="font-medium hover:text-${type === 'haki' ? 'purple' : 'yellow'}-600 transition-colors cursor-pointer">${item.judul_${type}}</td>
                                        ${type === 'paten' ? `<td>${item.jenis_paten}</td>` : ''}
                                        <td>${expired}</td>
                                        <td>${statusBadge}</td>
                                    </tr>
                                `);
                            } else {
                                statusBadge = item.status === 'Selesai' ?
                                    `<span class="status-badge status-active"><i class="fas fa-check-circle mr-1"></i>${item.status}</span>` :
                                    `<span class="status-badge status-pending"><i class="fas fa-spinner mr-1"></i>${item.status}</span>`;
                                tbody.append(`
                                    <tr>
                                        <td class="font-medium hover:text-${type === 'penelitian' ? 'blue' : 'green'}-600 transition-colors cursor-pointer">${item[`judul_${type}`]}</td>
                                        <td>${item.skema}</td>
                                        <td>${item.tahun}</td>
                                        <td>${statusBadge}</td>
                                    </tr>
                                `);
                            }
                        });
                    } else {
                        tbody.append('<tr><td colspan="' + (type === 'paten' ? '4' : type === 'haki' ? '3' : '4') + '" class="text-center py-4 text-gray-600">Tidak ada data ' + type + ' untuk kategori ini.</td></tr>');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat data.');
                }
            });
        }
    });
</script>