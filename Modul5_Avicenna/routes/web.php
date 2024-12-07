<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $nav = 'Dashboard';
    return view('dashboard', compact('nav'));
})->name('dashboard');

Route::get('/dosen', [dosenController::class, 'index'])->name('dosen.index');

Route::get('/dosen/create', [dosenController::class, 'create'])->name('dosen.create');

Route::post('/dosen', [dosenController::class, 'store'])->name('dosen.store');

Route::get('/dosen/{dosen}', [dosenController::class, 'show'])->name('dosen.show');

Route::get('/dosen/{dosen}/edit', [dosenController::class, 'edit'])->name('dosen.edit');

Route::put('/dosen/{dosen}', [dosenController::class, 'update'])->name('dosen.update');

Route::delete('/dosen/{dosen}', [dosenController::class, 'destroy'])->name('dosen.destroy');


Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');

Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');

Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');

Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
