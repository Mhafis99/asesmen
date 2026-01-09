<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;

// Halaman Login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Routes yang butuh autentikasi
Route::middleware(['auth'])->group(function () {

    // Redirect berdasarkan role
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isGuru()) {
            return redirect()->route('guru.dashboard');
        } else {
            return redirect()->route('siswa.dashboard');
        }
    })->name('dashboard');

    // Routes Admin (hanya role admin)
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Users
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'usersCreate'])->name('users.create');
        Route::post('/users', [AdminController::class, 'usersStore'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'usersEdit'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'usersUpdate'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'usersDelete'])->name('users.destroy');

        // Kelas
        Route::get('/kelas', [AdminController::class, 'kelas'])->name('kelas');
        Route::get('/kelas/create', [AdminController::class, 'kelasCreate'])->name('kelas.create');
        Route::post('/kelas', [AdminController::class, 'kelasStore'])->name('kelas.store');
        Route::get('/kelas/{id}/edit', [AdminController::class, 'kelasEdit'])->name('kelas.edit');
        Route::put('/kelas/{id}', [AdminController::class, 'kelasUpdate'])->name('kelas.update');
        Route::delete('/kelas/{id}', [AdminController::class, 'kelasDelete'])->name('kelas.destroy');

        // Jadwal Bimbingan
        Route::get('/jadwal-bimbingan', [AdminController::class, 'jadwalBimbingan'])->name('jadwal-bimbingan');
        Route::get('/jadwal-bimbingan/create', [AdminController::class, 'jadwalBimbinganCreate'])->name('jadwal-bimbingan.create');
        Route::post('/jadwal-bimbingan', [AdminController::class, 'jadwalBimbinganStore'])->name('jadwal-bimbingan.store');
        Route::delete('/jadwal-bimbingan/{id}', [AdminController::class, 'jadwalBimbinganDelete'])->name('jadwal-bimbingan.destroy');

        // Jadwal Lab
        Route::get('/jadwal-lab', [AdminController::class, 'jadwalLab'])->name('jadwal-lab');
        Route::get('/jadwal-lab/create', [AdminController::class, 'jadwalLabCreate'])->name('jadwal-lab.create');
        Route::post('/jadwal-lab', [AdminController::class, 'jadwalLabStore'])->name('jadwal-lab.store');
        Route::delete('/jadwal-lab/{id}', [AdminController::class, 'jadwalLabDelete'])->name('jadwal-lab.destroy');

        // Absensi
        Route::get('/absensi', [AdminController::class, 'absensi'])->name('absensi');

        // Nilai
        Route::get('/nilai', [AdminController::class, 'nilai'])->name('nilai');
    });

    // Routes Guru (role guru)
    Route::middleware(['guru'])->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');

        // Jadwal Bimbingan
        Route::get('/jadwal-bimbingan', [GuruController::class, 'jadwalBimbingan'])->name('jadwal-bimbingan');
        Route::get('/jadwal-bimbingan/create', [GuruController::class, 'jadwalBimbinganCreate'])->name('jadwal-bimbingan.create');
        Route::post('/jadwal-bimbingan', [GuruController::class, 'jadwalBimbinganStore'])->name('jadwal-bimbingan.store');
        Route::get('/jadwal-bimbingan/{id}/edit', [GuruController::class, 'jadwalBimbinganEdit'])->name('jadwal-bimbingan.edit');
        Route::put('/jadwal-bimbingan/{id}', [GuruController::class, 'jadwalBimbinganUpdate'])->name('jadwal-bimbingan.update');
        Route::delete('/jadwal-bimbingan/{id}', [GuruController::class, 'jadwalBimbinganDelete'])->name('jadwal-bimbingan.destroy');

        // Jadwal Lab
        Route::get('/jadwal-lab', [GuruController::class, 'jadwalLab'])->name('jadwal-lab');
        Route::get('/jadwal-lab/create', [GuruController::class, 'jadwalLabCreate'])->name('jadwal-lab.create');
        Route::post('/jadwal-lab', [GuruController::class, 'jadwalLabStore'])->name('jadwal-lab.store');
        Route::get('/jadwal-lab/{id}/edit', [GuruController::class, 'jadwalLabEdit'])->name('jadwal-lab.edit');
        Route::put('/jadwal-lab/{id}', [GuruController::class, 'jadwalLabUpdate'])->name('jadwal-lab.update');
        Route::delete('/jadwal-lab/{id}', [GuruController::class, 'jadwalLabDelete'])->name('jadwal-lab.destroy');

        // Absensi
        Route::get('/absensi', [GuruController::class, 'absensi'])->name('absensi');

        // Nilai
        Route::get('/nilai', [GuruController::class, 'nilai'])->name('nilai');
        Route::get('/nilai/create/{jadwalBimbinganId}', [GuruController::class, 'nilaiCreate'])->name('nilai.create');
        Route::post('/nilai', [GuruController::class, 'nilaiStore'])->name('nilai.store');
        Route::get('/nilai/{id}/edit', [GuruController::class, 'nilaiEdit'])->name('nilai.edit');
        Route::put('/nilai/{id}', [GuruController::class, 'nilaiUpdate'])->name('nilai.update');
    });

    // Routes Siswa (role siswa)
    Route::middleware(['siswa'])->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');

        // Jadwal Bimbingan
        Route::get('/jadwal-bimbingan', [SiswaController::class, 'jadwalBimbingan'])->name('jadwal-bimbingan');

        // Jadwal Lab
        Route::get('/jadwal-lab', [SiswaController::class, 'jadwalLab'])->name('jadwal-lab');

        // Nilai
        Route::get('/nilai', [SiswaController::class, 'nilai'])->name('nilai');

        // Profile
        Route::get('/profile', [SiswaController::class, 'profile'])->name('profile');
        Route::put('/profile', [SiswaController::class, 'profileUpdate'])->name('profile.update');
    });
});
