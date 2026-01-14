<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TUKController;
use App\Http\Controllers\AsesiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LSPController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ################################ LSP
Route::get('lsp', [LSPController::class, 'index'])->name('lsp.index');
Route::get('lsp/create', [LSPController::class, 'create'])->name('lsp.create')->middleware('auth');
Route::post('lsp/store', [LSPController::class, 'store'])->name('lsp.store');

// ################################ Kegiatan
Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index')->middleware('auth');
Route::get('kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create')->middleware('auth');
Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store')->middleware('auth');


Route::get('/dashboard', function () {
    return view('admin-panel.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ################################ Pendaftaraan Asesi
Route::get('asesi', [AsesiController::class, 'index'])->name('asesi.index');
Route::get('asesi/create', [AsesiController::class, 'create'])->name('asesi.create');
Route::post('asesi/store', [AsesiController::class, 'store'])->name('asesi.store');

// ################################ Pendaftaraan TUK
Route::get('tuk', [TUKController::class, 'index'])->name('tuk.index');
Route::get('tuk/create', [TUKController::class, 'create'])->name('tuk.create');
Route::post('tuk/store', [TUKController::class, 'store'])->name('tuk.store');

// ################################ Data Pegawai
Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');

require __DIR__ . '/auth.php';
