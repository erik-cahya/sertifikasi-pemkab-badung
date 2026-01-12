<?php

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
Route::get('lsp', [LSPController::class, 'index'])->name('lsp.index');
Route::get('lsp/create', [LSPController::class, 'create'])->name('lsp.create');

// ################################ Kegiatan
Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');

Route::get('/dashboard', function () {
    return view('admin-panel.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
