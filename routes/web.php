<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Rute Publik
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::post('/search', [PublicController::class, 'search'])->name('public.search');
Route::get('/category/{category}', [PublicController::class, 'category'])->name('public.category');

// Rute Autentikasi Admin
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Autentikasi Dosen (SSO)
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Rute Admin (memerlukan autentikasi dan role admin)
Route::middleware(['auth:web', 'admin'])->prefix('admin')->group(function () {
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
    Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('admin.dosen.show');
});

// Rute Dosen (memerlukan autentikasi dengan guard dosen)
Route::middleware(['auth:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('dosen.dashboard');
    })->name('dosen.dashboard');
    Route::get('/dosen/edit', [DosenController::class, 'editProfile'])->name('dosen.edit');
    Route::put('/dosen/update', [DosenController::class, 'updateProfile'])->name('dosen.update');
    Route::get('/dosen/penelitian/edit', [DosenController::class, 'editPenelitian'])->name('dosen.penelitian.edit');
    Route::put('/dosen/penelitian/update', [DosenController::class, 'updatePenelitian'])->name('dosen.penelitian.update');
    Route::get('/dosen/pengabdian/edit', [DosenController::class, 'editPengabdian'])->name('dosen.pengabdian.edit');
    Route::put('/dosen/pengabdian/update', [DosenController::class, 'updatePengabdian'])->name('dosen.pengabdian.update');
    Route::get('/dosen/haki/edit', [DosenController::class, 'editHaki'])->name('dosen.haki.edit');
    Route::put('/dosen/haki/update', [DosenController::class, 'updateHaki'])->name('dosen.haki.update');
    Route::get('/dosen/paten/edit', [DosenController::class, 'editPaten'])->name('dosen.paten.edit');
    Route::put('/dosen/paten/update', [DosenController::class, 'updatePaten'])->name('dosen.paten.update');
});