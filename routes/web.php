<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return auth()->check()
        ? redirect('/dashboard')
        : redirect('/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Route untuk menampilkan form edit profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route untuk update profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route untuk mengupdate password
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Route untuk menghapus akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// data siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->name('siswa.show');  // Tambahkan ini
Route::get('/siswa/search', [SiswaController::class, 'search'])->name('siswa.search');



Route::get('/agama', [AgamaController::class, 'index'])->name('agama.index');
Route::post('/agama', [AgamaController::class, 'store'])->name('agama.store');
Route::put('/agama/{id}', [AgamaController::class, 'update'])->name('agama.update');
Route::delete('/agama/{id}', [AgamaController::class, 'destroy'])->name('agama.destroy');

Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

// user management

Route::middleware(['role:admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'show', 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
});



require __DIR__ . '/auth.php';
