<?php

use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TUKController;
use App\Http\Controllers\AsesiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KegiatanDetailController;
use App\Http\Controllers\KodeUnitController;
use App\Http\Controllers\LSPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkemaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ajax/skema-by-lsp/{lspRef}', [SkemaController::class, 'getByLsp'])->name('ajax.skema.by-lsp');


Route::middleware('auth')->group(function () {

    // Selain role master & dinas, tidak bisa akses route ini
    Route::middleware(['role:master, dinas'])->group(function () {
        // ################################ LSP
        Route::get('lsp', [LSPController::class, 'index'])->name('lsp.index');
        Route::get('lsp/create', [LSPController::class, 'create'])->name('lsp.create');
        Route::post('lsp/store', [LSPController::class, 'store'])->name('lsp.store');
        Route::get('lsp/{id}', [LSPController::class, 'show'])->name('lsp.show');
        Route::delete('lsp/{id}', [LSPController::class, 'destroy'])->name('lsp.destroy');


        // ################################ Kegiatan
        Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');

        // ################################ Kegiatan Detail
        Route::post('kegiatan-detail', [KegiatanDetailController::class, 'store'])->name('kegiatan-detail.store');

        // ################################ Departemen
        Route::get('departemen', [DepartemenController::class, 'index'])->name('departemen.index');
        Route::post('departemen/store', [DepartemenController::class, 'store'])->name('departemen.store');
        Route::get('departemen/{id}', [DepartemenController::class, 'edit'])->name('departemen.edit');
        Route::put('departemen/{id}', [DepartemenController::class, 'update'])->name('departemen.update');
        Route::delete('departemen/{id}', [DepartemenController::class, 'destroy'])->name('departemen.destroy');

        // ################################ Jabatan
        Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
        Route::post('jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('jabatan/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit');
        Route::put('jabatan/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
        Route::delete('jabatan/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
    });

    // ################################ Skema
    Route::get('skema', [SkemaController::class, 'index'])->name('skema.index');
    Route::get('skema/create', [SkemaController::class, 'create'])->name('skema.create')->middleware('role:lsp');
    Route::post('skema/store', [SkemaController::class, 'store'])->name('skema.store')->middleware('role:lsp');
    Route::get('skema/{id}', [SkemaController::class, 'show'])->name('skema.show')->middleware('role:lsp');
    Route::put('skema/{id}', [SkemaController::class, 'update'])->name('skema.update')->middleware('role:lsp');
    Route::delete('skema/{id}', [SkemaController::class, 'destroy'])->name('skema.destroy')->middleware('role:lsp');

    // ################################ Kode Unit
    Route::post('skema/create_kode_unit', [KodeUnitController::class, 'store'])->name('kode_unit.store')->middleware('role:lsp');
    Route::put('kode_unit/{id}', [KodeUnitController::class, 'update'])->name('kode_unit.update')->middleware('role:lsp');
    Route::delete('kode_unit/{id}', [KodeUnitController::class, 'destroy'])->name('kode_unit.destroy')->middleware('role:lsp');

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
