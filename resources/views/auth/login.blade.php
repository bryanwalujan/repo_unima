<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Repositori Dosen - Universitas Negeri Manado</title>
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
        
        .login-card {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--unima-blue) 0%, #0f2c6e 100%);
        }
        
        .input-field {
            background-image: none !important;
            padding-left: 16px !important;
            transition: all 0.3s ease;
            border-radius: 10px;
        }
        
        .input-field:focus {
            border-color: var(--unima-light-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        
        .btn-login, .btn-sso {
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            font-weight: 600;
            border-radius: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 58, 138, 0.3);
        }
        
        .btn-sso:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 149, 255, 0.3);
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .error-message {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="absolute top-0 left-0 w-full h-1/2 bg-gradient-to-b from-blue-50 to-transparent z-0"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 w-16 h-16 rounded-full bg-blue-200 opacity-20 floating"></div>
    <div class="absolute bottom-20 right-10 w-24 h-24 rounded-full bg-blue-200 opacity-15 floating" style="animation-delay: 2s;"></div>
    
    <div class="relative z-10 w-full max-w-md">
        <!-- Logo Section -->
        <div class="flex justify-center mb-8">
            <div class="bg-white p-4 rounded-full shadow-lg">
                <div class="gradient-bg text-white p-4 rounded-full">
                    <i class="fas fa-user-shield text-3xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Login Card -->
        <div class="login-card bg-white overflow-hidden">
            <!-- Card Header -->
            <div class="gradient-bg text-white p-6 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 opacity-20">
                    <i class="fas fa-lock text-[100px]"></i>
                </div>
                <h2 class="text-2xl font-bold relative z-10 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-3"></i> Login
                </h2>
                <p class="text-blue-100 mt-2 relative z-10">Repositori Dosen Teknik Informatika</p>
            </div>
            
            <!-- Card Body -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="error-message bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Login untuk Admin -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Login Admin</h3>
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2 flex items-center">
                                <i class="fas fa-envelope mr-2 text-blue-500"></i> Email
                            </label>
                            <div class="relative">
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="input-field w-full p-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>
                        </div>
                        
                        <!-- Password Field -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2 flex items-center">
                                <i class="fas fa-lock mr-2 text-blue-500"></i> Password
                            </label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    name="password" 
                                    class="input-field w-full p-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    required
                                >
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" class="btn-login w-full gradient-bg text-white py-4 px-4 rounded-lg font-bold hover:opacity-90">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                        </button>
                    </form>
                </div>

                <!-- Login untuk Dosen (SSO) -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Login Dosen</h3>
                    <a href="{{ route('login.google') }}" class="btn-sso w-full bg-blue-600 text-white py-4 px-4 rounded-lg flex items-center justify-center hover:bg-blue-700">
                        <i class="fab fa-google mr-2"></i> Login dengan Google
                    </a>
                </div>
            </div>
            
            <!-- Card Footer -->
            <div class="bg-gray-50 px-6 py-4 text-center border-t">
                <p class="text-sm text-gray-600">
                    © 2025 Repositori Dosen - Teknik Informatika UNIMA
                </p>
            </div>
        </div>
    </div>
</body>
</html>