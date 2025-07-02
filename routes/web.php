<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Rute Publik
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::post('/search', [PublicController::class, 'search'])->name('public.search');
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::post('/search', [PublicController::class, 'search'])->name('public.search');
Route::get('/category/{category}', [PublicController::class, 'category'])->name('public.category');

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Admin (memerlukan autentikasi dan role admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('admin.dosen.create');
    Route::post('/dosen', [DosenController::class, 'store'])->name('admin.dosen.store');
    Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('admin.dosen.edit');
    Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('admin.dosen.update');
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('admin.dosen.destroy');
    Route::post('/dosen/import', [DosenController::class, 'import'])->name('admin.dosen.import');
    Route::get('admin/dosen/{id}', [DosenController::class, 'show'])->name('admin.dosen.show');
});