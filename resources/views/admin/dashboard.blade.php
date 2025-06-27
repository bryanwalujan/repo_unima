<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Dashboard Admin</h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Selamat Datang, {{ Auth::user()->name }}</h3>
            <p>Ini adalah dashboard Ats dashboard admin untuk mengelola data dosen.</p>
            <div class="mt-4">
                <a href="{{ route('admin.dosen.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mr-2">Lihat Data Dosen</a>
                <a href="{{ route('admin.dosen.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tambah Dosen</a>
            </div>
        </div>
    </div>
</body>
</html>