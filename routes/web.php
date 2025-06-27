<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
    Route::get('/admin/dosen/create', [DosenController::class, 'create'])->name('admin.dosen.create');
    Route::post('/admin/dosen', [DosenController::class, 'store'])->name('admin.dosen.store');
    Route::post('/admin/dosen/import', [DosenController::class, 'import'])->name('admin.dosen.import');
});