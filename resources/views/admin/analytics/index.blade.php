<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Analytics - Repositori Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
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
        
        .summary-card {
            transition: all 0.3s;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-left: 4px solid;
        }
        
        .summary-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .chart-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            transition: all 0.3s;
        }
        
        .chart-container:hover {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
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
            <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center py-3 px-6">
                <i class="fas fa-tachometer-alt text-blue-300 mr-3"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.dosen.index') }}" class="nav-link flex items-center py-3 px-6">
                <i class="fas fa-user-tie text-blue-300 mr-3"></i>
                <span>Data Dosen</span>
            </a>
            <a href="{{ route('admin.analytics.index') }}" class="nav-link active flex items-center py-3 px-6">
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
                    <h1 class="text-xl font-bold text-gray-800">Dashboard Analytics</h1>
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
            <!-- Summary Cards -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-pie text-blue-600 mr-2"></i>
                    Ringkasan Statistik
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div class="summary-card bg-white border-l-blue-500">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-user-tie text-blue-600"></i>
                                </div>
                                <h3 class="text-md font-semibold">Total Dosen</h3>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalDosens }}</p>
                        </div>
                    </div>
                    
                    <div class="summary-card bg-white border-l-green-500">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="bg-green-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-flask text-green-600"></i>
                                </div>
                                <h3 class="text-md font-semibold">Total Penelitian</h3>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalPenelitians }}</p>
                        </div>
                    </div>
                    
                    <div class="summary-card bg-white border-l-yellow-500">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-hands-helping text-yellow-600"></i>
                                </div>
                                <h3 class="text-md font-semibold">Total Pengabdian</h3>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalPengabdians }}</p>
                        </div>
                    </div>
                    
                    <div class="summary-card bg-white border-l-purple-500">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-copyright text-purple-600"></i>
                                </div>
                                <h3 class="text-md font-semibold">Total HAKI</h3>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalHakis }}</p>
                        </div>
                    </div>
                    
                    <div class="summary-card bg-white border-l-red-500">
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="bg-red-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-file-alt text-red-600"></i>
                                </div>
                                <h3 class="text-md font-semibold">Total Paten</h3>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalPatens }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                    Visualisasi Data
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Penelitian per Tahun -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            Penelitian per Tahun
                        </h3>
                        <canvas id="penelitianPerTahunChart"></canvas>
                    </div>

                    <!-- Distribusi Skema Penelitian -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-pie-chart text-green-500 mr-2"></i>
                            Distribusi Skema Penelitian
                        </h3>
                        <canvas id="skemaPenelitianChart"></canvas>
                    </div>

                    <!-- Top 5 Dosen Penelitian -->
                    <div class="chart-container md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                            Top 5 Dosen Produktif (Penelitian)
                        </h3>
                        <canvas id="topDosenChart"></canvas>
                    </div>

                    <!-- Pengabdian per Tahun -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            Pengabdian per Tahun
                        </h3>
                        <canvas id="pengabdianPerTahunChart"></canvas>
                    </div>

                    <!-- Distribusi Skema Pengabdian -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-pie-chart text-green-500 mr-2"></i>
                            Distribusi Skema Pengabdian
                        </h3>
                        <canvas id="skemaPengabdianChart"></canvas>
                    </div>

                    <!-- Top 5 Dosen Pengabdian -->
                    <div class="chart-container md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                            Top 5 Dosen Produktif (Pengabdian)
                        </h3>
                        <canvas id="topDosenPengabdianChart"></canvas>
                    </div>

                    <!-- HAKI per Tahun -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            HAKI per Tahun
                        </h3>
                        <canvas id="hakiPerTahunChart"></canvas>
                    </div>

                    <!-- Distribusi Status HAKI -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-pie-chart text-green-500 mr-2"></i>
                            Distribusi Status HAKI
                        </h3>
                        <canvas id="statusHakiChart"></canvas>
                    </div>

                    <!-- Top 5 Dosen HAKI -->
                    <div class="chart-container md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                            Top 5 Dosen Produktif (HAKI)
                        </h3>
                        <canvas id="topDosenHakiChart"></canvas>
                    </div>

                    <!-- Paten per Tahun -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            Paten per Tahun
                        </h3>
                        <canvas id="patenPerTahunChart"></canvas>
                    </div>

                    <!-- Distribusi Jenis Paten -->
                    <div class="chart-container">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-pie-chart text-green-500 mr-2"></i>
                            Distribusi Jenis Paten
                        </h3>
                        <canvas id="jenisPatenChart"></canvas>
                    </div>

                    <!-- Top 5 Dosen Paten -->
                    <div class="chart-container md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                            Top 5 Dosen Produktif (Paten)
                        </h3>
                        <canvas id="topDosenPatenChart"></canvas>
                    </div>
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

            // Penelitian per Tahun (Line Chart)
            const penelitianPerTahunCtx = document.getElementById('penelitianPerTahunChart').getContext('2d');
            new Chart(penelitianPerTahunCtx, {
                type: 'line',
                data: {
                    labels: @json(array_keys($penelitianPerTahun)),
                    datasets: [{
                        label: 'Jumlah Penelitian',
                        data: @json(array_values($penelitianPerTahun)),
                        borderColor: '#1e3a8a',
                        backgroundColor: 'rgba(30, 58, 138, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointBackgroundColor: '#1e3a8a',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Penelitian',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            // Distribusi Skema Penelitian (Pie Chart)
            const skemaPenelitianCtx = document.getElementById('skemaPenelitianChart').getContext('2d');
            new Chart(skemaPenelitianCtx, {
                type: 'pie',
                data: {
                    labels: @json(array_keys($skemaPenelitian)),
                    datasets: [{
                        data: @json(array_values($skemaPenelitian)),
                        backgroundColor: [
                            '#1e3a8a',
                            '#166534',
                            '#991b1b',
                            '#6b21a8',
                            '#92400e',
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    }
                }
            });

            // Top 5 Dosen Penelitian (Bar Chart)
            const topDosenCtx = document.getElementById('topDosenChart').getContext('2d');
            new Chart(topDosenCtx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($topDosen, 'nama')),
                    datasets: [{
                        label: 'Jumlah Penelitian',
                        data: @json(array_column($topDosen, 'total_penelitian')),
                        backgroundColor: '#1e3a8a',
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Penelitian',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Nama Dosen',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            // Pengabdian per Tahun (Line Chart)
            const pengabdianPerTahunCtx = document.getElementById('pengabdianPerTahunChart').getContext('2d');
            new Chart(pengabdianPerTahunCtx, {
                type: 'line',
                data: {
                    labels: @json(array_keys($pengabdianPerTahun)),
                    datasets: [{
                        label: 'Jumlah Pengabdian',
                        data: @json(array_values($pengabdianPerTahun)),
                        borderColor: '#166534',
                        backgroundColor: 'rgba(22, 101, 52, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointBackgroundColor: '#166534',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Pengabdian',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            // Distribusi Skema Pengabdian (Pie Chart)
            const skemaPengabdianCtx = document.getElementById('skemaPengabdianChart').getContext('2d');
            new Chart(skemaPengabdianCtx, {
                type: 'pie',
                data: {
                    labels: @json(array_keys($skemaPengabdian)),
                    datasets: [{
                        data: @json(array_values($skemaPengabdian)),
                        backgroundColor: [
                            '#166534',
                            '#1e3a8a',
                            '#991b1b',
                            '#6b21a8',
                            '#92400e',
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    }
                }
            });

            // Top 5 Dosen Pengabdian (Bar Chart)
            const topDosenPengabdianCtx = document.getElementById('topDosenPengabdianChart').getContext('2d');
            new Chart(topDosenPengabdianCtx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($topDosenPengabdian, 'nama')),
                    datasets: [{
                        label: 'Jumlah Pengabdian',
                        data: @json(array_column($topDosenPengabdian, 'total_pengabdian')),
                        backgroundColor: '#166534',
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Pengabdian',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Nama Dosen',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            // HAKI per Tahun (Line Chart)
            const hakiPerTahunCtx = document.getElementById('hakiPerTahunChart').getContext('2d');
            new Chart(hakiPerTahunCtx, {
                type: 'line',
                data: {
                    labels: @json(array_keys($hakiPerTahun)),
                    datasets: [{
                        label: 'Jumlah HAKI',
                        data: @json(array_values($hakiPerTahun)),
                        borderColor: '#6b21a8',
                        backgroundColor: 'rgba(107, 33, 168, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointBackgroundColor: '#6b21a8',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah HAKI',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            // Distribusi Status HAKI (Pie Chart)
            const statusHakiCtx = document.getElementById('statusHakiChart').getContext('2d');
            new Chart(statusHakiCtx, {
                type: 'pie',
                data: {
                    labels: @json(array_keys($statusHaki)),
                    datasets: [{
                        data: @json(array_values($statusHaki)),
                        backgroundColor: [
                            '#6b21a8',
                            '#991b1b',
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    }
                }
            });

            // Top 5 Dosen HAKI (Bar Chart)
            const topDosenHakiCtx = document.getElementById('topDosenHakiChart').getContext('2d');
            new Chart(topDosenHakiCtx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($topDosenHaki, 'nama')),
                    datasets: [{
                        label: 'Jumlah HAKI',
                        data: @json(array_column($topDosenHaki, 'total_haki')),
                        backgroundColor: '#6b21a8',
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah HAKI',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Nama Dosen',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            // Paten per Tahun (Line Chart)
            const patenPerTahunCtx = document.getElementById('patenPerTahunChart').getContext('2d');
            new Chart(patenPerTahunCtx, {
                type: 'line',
                data: {
                    labels: @json(array_keys($patenPerTahun)),
                    datasets: [{
                        label: 'Jumlah Paten',
                        data: @json(array_values($patenPerTahun)),
                        borderColor: '#92400e',
                        backgroundColor: 'rgba(146, 64, 14, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointBackgroundColor: '#92400e',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Paten',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tahun',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });

            // Distribusi Jenis Paten (Pie Chart)
            const jenisPatenCtx = document.getElementById('jenisPatenChart').getContext('2d');
            new Chart(jenisPatenCtx, {
                type: 'pie',
                data: {
                    labels: @json(array_keys($jenisPaten)),
                    datasets: [{
                        data: @json(array_values($jenisPaten)),
                        backgroundColor: [
                            '#92400e',
                            '#1e3a8a',
                            '#166534',
                            '#6b21a8',
                            '#991b1b',
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    }
                }
            });

            // Top 5 Dosen Paten (Bar Chart)
            const topDosenPatenCtx = document.getElementById('topDosenPatenChart').getContext('2d');
            new Chart(topDosenPatenCtx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($topDosenPaten, 'nama')),
                    datasets: [{
                        label: 'Jumlah Paten',
                        data: @json(array_column($topDosenPaten, 'total_paten')),
                        backgroundColor: '#92400e',
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Paten',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Nama Dosen',
                                font: {
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>