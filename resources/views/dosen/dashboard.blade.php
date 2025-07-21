<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen | Repositori Dosen - Universitas Negeri Manado</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        :root {
            --unima-blue: #1e3a8a;
            --unima-gold: #d4af37;
            --unima-light-blue: #3b82f6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f7ff 0%, #e6f2ff 100%);
            background-attachment: fixed;
        }

        .dashboard-card {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--unima-blue) 0%, #0f2c6e 100%);
        }

        .btn-action {
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 58, 138, 0.3);
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
            100% {
                transform: translateY(0px);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="absolute top-0 left-0 w-full h-1/2 bg-gradient-to-b from-blue-50 to-transparent z-0"></div>

    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-blue-200 opacity-20 floating"></div>
    <div class="absolute bottom-20 right-10 w-24 h-24 rounded-full bg-blue-200 opacity-15 floating" style="animation-delay: 2s;"></div>

    <div class="relative z-10 w-full max-w-2xl">
        <!-- Header Dashboard -->
        <div class="dashboard-card bg-white">
            <div class="gradient-bg text-white p-6 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 opacity-20">
                    <i class="fas fa-user-graduate text-[100px]"></i>
                </div>
                <h2 class="text-2xl font-bold relative z-10 flex items-center justify-center">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard Dosen
                </h2>
                <p class="text-blue-100 mt-2 relative z-10">Selamat datang di Repositori Dosen Teknik Informatika</p>
            </div>

            <!-- Body Dashboard -->
            <div class="p-8">
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3 text-xl"></i>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                            <p>{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Dosen -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4 text-gray-700">Informasi Pribadi</h3>
                        <p><strong>Nama:</strong> {{ Auth::guard('dosen')->user()->nama ?? 'Tidak tersedia' }}</p>
                        <p><strong>Email:</strong> {{ Auth::guard('dosen')->user()->email ?? 'Tidak tersedia' }}</p>
                        <p><strong>NIDN:</strong> {{ Auth::guard('dosen')->user()->nidn ?? 'Tidak tersedia' }}</p>
                        <p><strong>NIP:</strong> {{ Auth::guard('dosen')->user()->nip ?? 'Tidak tersedia' }}</p>
                        <p><strong>NUPTK:</strong> {{ Auth::guard('dosen')->user()->nuptk ?? 'Tidak tersedia' }}</p>
                        @if (Auth::guard('dosen')->user()->foto)
                            <p class="mt-4"><strong>Foto:</strong> <img
                                    src="{{ asset('storage/' . Auth::guard('dosen')->user()->foto) }}" alt="Foto Dosen"
                                    class="w-24 h-24 object-cover rounded-full"></p>
                        @endif
                    </div>

                    <!-- Aksi Cepat -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4 text-gray-700">Aksi Cepat</h3>
                        <a href="{{ route('dosen.edit') }}"
                            class="btn-action w-full bg-green-600 text-white py-3 px-4 rounded-lg flex items-center justify-center mb-4 hover:bg-green-700">
                            <i class="fas fa-edit mr-2"></i> Edit Profil
                        </a>
                        <a href="{{ route('dosen.penelitian.edit') }}"
                            class="btn-action w-full bg-blue-600 text-white py-3 px-4 rounded-lg flex items-center justify-center mb-4 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i> Tambah Penelitian ({{ Auth::guard('dosen')->user()->penelitians->count() }})
                        </a>
                        <a href="{{ route('dosen.pengabdian.edit') }}"
                            class="btn-action w-full bg-yellow-600 text-white py-3 px-4 rounded-lg flex items-center justify-center mb-4 hover:bg-yellow-700">
                            <i class="fas fa-hands-helping mr-2"></i> Tambah Pengabdian ({{ Auth::guard('dosen')->user()->pengabdians->count() }})
                        </a>
                        <a href="{{ route('dosen.haki.edit') }}"
                            class="btn-action w-full bg-purple-600 text-white py-3 px-4 rounded-lg flex items-center justify-center mb-4 hover:bg-purple-700">
                            <i class="fas fa-copyright mr-2"></i> Tambah HAKI ({{ Auth::guard('dosen')->user()->hakis->count() }})
                        </a>
                        <a href="{{ route('dosen.paten.edit') }}"
                            class="btn-action w-full bg-red-600 text-white py-3 px-4 rounded-lg flex items-center justify-center mb-4 hover:bg-red-700">
                            <i class="fas fa-patent mr-2"></i> Tambah Paten ({{ Auth::guard('dosen')->user()->patens->count() }})
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="btn-action w-full bg-red-600 text-white py-3 px-4 rounded-lg flex items-center justify-center hover:bg-red-700">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center border-t">
                <p class="text-sm text-gray-600">
                    © 2025 Repositori Dosen - Teknik Informatika UNIMA
                </p>
            </div>
        </div>
    </div>
</body>

</html>