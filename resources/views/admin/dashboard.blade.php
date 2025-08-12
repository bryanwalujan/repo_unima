<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Repositori Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --unima-blue: #1e3a8a;
            --unima-gold: #d4af37;
            --unima-light-blue: #3b82f6;
            --sidebar-width: 260px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
        }
        
        .sidebar {
            width: var(--sidebar-width);
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, var(--unima-blue) 0%, #0f2c6e 100%);
            color: white;
        }
        
        .main-content {
            width: calc(100% - var(--sidebar-width));
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
                height: 100vh;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                width: 100%;
                margin-left: 0;
            }
        }
        
        .nav-link {
            transition: all 0.2s;
            position: relative;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .nav-link.active {
            color: white;
        }
        
        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--unima-gold);
        }
        
        .header-gradient {
            background: linear-gradient(135deg, var(--unima-blue) 0%, #0f2c6e 100%);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--unima-gold) 0%, #b8860b 100%);
        }
        
        .hamburger {
            display: none;
        }
        
        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }
        }
        
        .action-card {
            transition: all 0.3s;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            height: 100%;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        
        .welcome-banner {
            background: linear-gradient(135deg, var(--unima-blue) 0%, #0f2c6e 100%);
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }
        
        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            transform: rotate(30deg);
        }
    </style>
</head>
<body class="flex">
    <!-- Sidebar -->
    <div class="sidebar fixed h-full">
        <div class="p-5 flex items-center border-b border-blue-700">
            <div class="bg-white p-3 rounded-lg mr-3">
                <i class="fas fa-graduation-cap text-blue-800 text-xl"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold">Repositori Dosen</h1>
                <p class="text-xs text-blue-200">Admin Dashboard</p>
            </div>
        </div>
        
        <div class="py-4">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active flex items-center py-3 px-6">
                <i class="fas fa-tachometer-alt text-blue-300 mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.dosen.index') }}" class="nav-link flex items-center py-3 px-6">
                <i class="fas fa-user-tie text-blue-300 mr-3"></i>
                <span>Data Dosen</span>
            </a>
            <a href="{{ route('admin.analytics.index') }}" class="nav-link flex items-center py-3 px-6">
                <i class="fas fa-chart-bar text-blue-300 mr-3"></i>
                <span>Analytics</span>
            </a>
        </div>
        
        <div class="absolute bottom-0 w-full p-4 border-t border-blue-700">
            <div class="flex items-center">
                <div class="user-avatar rounded-full flex items-center justify-center text-white font-bold mr-3">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-blue-300">Administrator</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content min-h-screen flex flex-col">
        <!-- Topbar -->
        <header class="bg-white shadow-sm">
            <div class="flex justify-between items-center p-4">
                <div class="flex items-center">
                    <button id="menu-toggle" class="hamburger mr-4 text-gray-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-bold text-gray-800">Dashboard Admin</h1>
                </div>
                
                <div class="flex items-center space-x-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center text-red-600 hover:text-red-800 transition-colors font-medium">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-grow p-6">
            <!-- Welcome Banner -->
            <div class="welcome-banner text-white p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-center relative z-10">
                    <div class="md:w-3/4 mb-6 md:mb-0">
                        <h1 class="text-2xl md:text-3xl font-bold mb-3">Selamat Datang, {{ Auth::user()->name }}</h1>
                        <p class="text-blue-100 max-w-3xl">
                            Ini adalah dashboard admin untuk mengelola data dosen Program Studi Teknik Informatika 
                            Universitas Negeri Manado. Anda dapat menambahkan, mengedit, dan mengelola data dosen.
                        </p>
                    </div>
                    <div class="md:w-1/4 flex justify-center">
                        <div class="bg-blue-600/30 p-5 rounded-full">
                            <i class="fas fa-user-shield text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Cards -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-tasks text-blue-600 mr-2"></i>
                    Kelola Data Dosen
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Lihat Data Dosen -->
                    <a href="{{ route('admin.dosen.index') }}" class="action-card bg-white">
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-list text-blue-600 text-xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Lihat Data Dosen</h3>
                            </div>
                            <p class="text-gray-600 mb-4 flex-grow">
                                Kelola semua data dosen termasuk profil, penelitian, pengabdian, dan karya akademik.
                            </p>
                            <div class="text-blue-600 font-medium flex items-center mt-auto">
                                <span>Akses Data</span>
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Tambah Dosen -->
                    <a href="{{ route('admin.dosen.create') }}" class="action-card bg-white">
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex items-center mb-4">
                                <div class="bg-green-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-user-plus text-green-600 text-xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Tambah Dosen</h3>
                            </div>
                            <p class="text-gray-600 mb-4 flex-grow">
                                Tambahkan dosen baru ke dalam sistem dengan mengisi data profil dan informasi akademik.
                            </p>
                            <div class="text-green-600 font-medium flex items-center mt-auto">
                                <span>Tambahkan Sekarang</span>
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </div>
                        </div>
                    </a>
                    
                    <!-- Dashboard Analytics -->
                    <a href="{{ route('admin.analytics.index') }}" class="action-card bg-white">
                        <div class="p-6 flex flex-col h-full">
                            <div class="flex items-center mb-4">
                                <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Dashboard Analytics</h3>
                            </div>
                            <p class="text-gray-600 mb-4 flex-grow">
                                Lihat analisis dan visualisasi data akademik seperti tren penelitian dan produktivitas dosen.
                            </p>
                            <div class="text-purple-600 font-medium flex items-center mt-auto">
                                <span>Lihat Analytics</span>
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-white border-t py-4 px-6 text-center text-gray-600 text-sm">
            <p>&copy; {{ date('Y') }} Repositori Dosen - Teknik Informatika Universitas Negeri Manado</p>
            <p class="mt-1">Sistem Administrasi Dosen dan Karya Akademik</p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.querySelector('.sidebar');
            
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
            
            // Close sidebar when clicking outside
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickInsideMenuToggle = menuToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickInsideMenuToggle && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>