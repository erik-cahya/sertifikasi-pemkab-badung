<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TUKController;
use App\Http\Controllers\AsesiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KodeUnitController;
use App\Http\Controllers\LSPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkemaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::delete('lsp/{id}', [LSPController::class, 'destroy'])->name('lsp.destroy');

Route::middleware('auth')->group(function () {

    // Selain role master & dinas, tidak bisa akses route ini
    Route::middleware(['role:master, dinas'])->group(function () {
        // ################################ LSP
        Route::get('lsp', [LSPController::class, 'index'])->name('lsp.index');
        Route::get('lsp/create', [LSPController::class, 'create'])->name('lsp.create');
        Route::post('lsp/store', [LSPController::class, 'store'])->name('lsp.store');

        // ################################ Kegiatan
        Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');

        // ################################ Items
        Route::get('item', [ItemController::class, 'index'])->name('item.index');
        Route::get('item/create', [ItemController::class, 'create'])->name('item.create')->middleware('role:lsp');
        Route::post('item/store', [ItemController::class, 'store'])->name('item.store');
        Route::get('item/{id}', [ItemController::class, 'show'])->name('item.show');
        Route::delete('item/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

        Route::get('departemen', [ItemController::class, 'index'])->name('departemen.index');
        Route::get('departemen/create', [ItemController::class, 'create'])->name('departemen.create')->middleware('role:lsp');
        Route::post('departemen/store', [ItemController::class, 'store'])->name('departemen.store');
        Route::get('departemen/{id}', [ItemController::class, 'show'])->name('departemen.show');
        Route::delete('departemen/{id}', [ItemController::class, 'destroy'])->name('departemen.destroy');
    });

    // ################################ Skema
    Route::get('skema', [SkemaController::class, 'index'])->name('skema.index');
    Route::get('skema/create', [SkemaController::class, 'create'])->name('skema.create')->middleware('role:lsp');
    Route::post('skema/store', [SkemaController::class, 'store'])->name('skema.store');
    Route::get('skema/{id}', [SkemaController::class, 'show'])->name('skema.show');
    Route::delete('skema/{id}', [SkemaController::class, 'destroy'])->name('skema.destroy');

    Route::post('skema/create_kode_unit', [KodeUnitController::class, 'store'])->name('kode_unit.store')->middleware('role:lsp');
    Route::delete('kode_unit/{id}', [KodeUnitController::class, 'destroy'])->name('kode_unit.destroy');

    // ################################ Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ################################ Dashboard
    Route::get('/dashboard', function () {
        return view('admin-panel.dashboard.index');
    })->name('dashboard');

    // ################################ TUK by admin
    Route::get('tukAdmin', [TUKController::class, 'index'])->name('tukAdmin.index');
    Route::get('tukAdmin/create', [TUKController::class, 'create'])->name('tukAdmin.create')->middleware('role:lsp');
    Route::post('tukAdmin/store', [TUKController::class, 'store'])->name('tukAdmin.store');
    Route::get('tukAdmin/{id}', [TUKController::class, 'show'])->name('tukAdmin.show');
    Route::delete('tukAdmin/{id}', [TUKController::class, 'destroy'])->name('tukAdmin.destroy');
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
