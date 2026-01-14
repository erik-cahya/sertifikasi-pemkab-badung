<?php

use App\Http\Controllers\AsesiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LSPController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('pendaftaran-asesi', function () {
    return view('pendaftaran.pendaftaran-asesi');
});
Route::get('pendaftaran-lsp', function () {
    return view('pendaftaran.pendaftaran-lsp');
});


// ################################ LSP
Route::get('lsp', [LSPController::class, 'index'])->name('lsp.index')->middleware('auth');
Route::get('lsp/create', [LSPController::class, 'create'])->name('lsp.create')->middleware('auth');
Route::post('lsp/store', [LSPController::class, 'store'])->name('lsp.store')->middleware('auth');

// ################################ Kegiatan
Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index')->middleware('auth');
Route::get('kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create')->middleware('auth');
Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store')->middleware('auth');

// ################################ Pendaftaraan Asesi
Route::get('asesi', [AsesiController::class, 'index'])->name('asesi.index')->middleware('auth');
Route::get('asesi/create', [AsesiController::class, 'create'])->name('asesi.create')->middleware('auth');
Route::post('asesi/store', [AsesiController::class, 'store'])->name('asesi.store')->middleware('auth');

Route::get('/dashboard', function () {
    return view('admin-panel.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
