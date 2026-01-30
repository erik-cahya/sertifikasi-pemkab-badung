<?php

use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TUKController;
use App\Http\Controllers\AsesiController;
use App\Http\Controllers\AsesmenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KegiatanDetailController;
use App\Http\Controllers\KegiatanLSPController;
use App\Http\Controllers\KodeUnitController;
use App\Http\Controllers\LSPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('/ajax/skema-by-lsp/{lspRef}', [SkemaController::class, 'getByLsp'])->name('ajax.skema.by-lsp');


Route::get('/ajax/lsp-by-kegiatan/{kegiatan}', [AsesiController::class, 'getLspByKegiatan']);

Route::get('/ajax/skema-by-kegiatan-lsp', [AsesiController::class, 'getSkemaByKegiatanLsp']);
Route::get('/ajax/jadwal-by-lsp', [AsesiController::class, 'getJadwalByLsp']);
Route::get('/ajax/tuk-by-lsp', [AsesiController::class, 'getTukByLsp']);

Route::get('/ajax/getJabatanByDepartemen/{departemenNama}', [JabatanController::class, 'getJabatanByDepartemen']);

Route::get('/', function () {
    return view('home');
});
Route::middleware('auth')->group(function () {

    // ################################ Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // ################################ Kegiatan
    Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::get('kegiatan/add-lsp/{id}', [KegiatanController::class, 'add_lsp'])->name('kegiatan.add-lsp');
    Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('kegiatan/{id}', [KegiatanController::class, 'show'])->name('kegiatan.show');
    Route::put('kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    // Selain role master & dinas, tidak bisa akses route ini
    Route::middleware(['role:master, dinas'])->group(function () {
        // ################################ LSP
        Route::get('lsp', [LSPController::class, 'index'])->name('lsp.index');
        Route::get('lsp/create', [LSPController::class, 'create'])->name('lsp.create');
        Route::post('lsp/store', [LSPController::class, 'store'])->name('lsp.store');
        Route::get('lsp/{id}', [LSPController::class, 'show'])->name('lsp.show');
        Route::delete('lsp/{id}', [LSPController::class, 'destroy'])->name('lsp.destroy');

        Route::get('jadwalAsesmen', [KegiatanController::class, 'jadwalAsesmen'])->name('jadwal.asesmen');

        // ################################ Asesmen by Admin
        Route::resource('asesmen', AsesmenController::class)->except('index');

        // ################################ Kegiatan LSP
        Route::post('kegiatan-detail', [KegiatanLSPController::class, 'store'])->name('kegiatan-lsp.store');

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

    // Role LSP
    Route::middleware(['role:lsp,master, dinas'])->group(function () {
        // ################################ Skema
        Route::get('skema', [SkemaController::class, 'index'])->name('skema.index');
        Route::get('skema/create', [SkemaController::class, 'create'])->name('skema.create');
        Route::post('skema/store', [SkemaController::class, 'store'])->name('skema.store');
        Route::get('skema/{id}', [SkemaController::class, 'show'])->name('skema.show');
        Route::put('skema/{id}', [SkemaController::class, 'update'])->name('skema.update');
        Route::delete('skema/{id}', [SkemaController::class, 'destroy'])->name('skema.destroy');

        // ################################ Kode Unit
        Route::post('skema/create_kode_unit', [KodeUnitController::class, 'store'])->name('kode_unit.store');
        Route::put('kode_unit/{id}', [KodeUnitController::class, 'update'])->name('kode_unit.update');
        Route::delete('kode_unit/{id}', [KodeUnitController::class, 'destroy'])->name('kode_unit.destroy');
    });



    // ################################ Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ################################ TUK by admin
    Route::get('tukAdmin', [TUKController::class, 'list'])->name('tukAdmin.index');
    Route::get('tukAdmin/create', [TUKController::class, 'create'])->name('tukAdmin.create');
    Route::post('tukAdmin/store', [TUKController::class, 'store'])->name('tukAdmin.store');
    Route::get('tukAdmin/{id}', [TUKController::class, 'edit'])->name('tukAdmin.edit');
    Route::put('tukAdmin/{id}', [TUKController::class, 'update'])->name('tukAdmin.update');
    Route::get('tukAdmin/{id}/{code}', [TUKController::class, 'verifikasi'])->name('tukAdmin.verifikasi');
    Route::delete('tukAdmin/{id}', [TUKController::class, 'destroy'])->name('tukAdmin.destroy');

    // ################################ Asesi by admin
    Route::get('asesiAdmin', [AsesiController::class, 'list'])->name('asesiAdmin.index');

    // ################################ Generate PDF
    // Route::get('daftar-hadir/{id}', [PDFController::class, 'daftarHadir'])->name('pdf.daftar-hadir');
    // Route::get('daftar-penerimaan/{id}', [PDFController::class, 'daftarPenerimaan'])->name('pdf.daftar-penerimaan');
    // Route::get('tanda-terima-sertifikat/{id}', [PDFController::class, 'daftandaTerimaSertifikattarHadir'])->name('pdf.tanda-terima-sertifikat');
    // PAKAI TEST BELUM GET REF
    Route::get('daftar-hadir', [PDFController::class, 'daftarHadir'])->name('pdf.daftar-hadir');
    Route::get('daftar-penerimaan', [PDFController::class, 'daftarPenerimaan'])->name('pdf.daftar-penerimaan');
    Route::get('tanda-terima-sertifikat', [PDFController::class, 'daftandaTerimaSertifikattarHadir'])->name('pdf.tanda-terima-sertifikat');

});

// ################################ Pendaftaraan Asesi
Route::get('asesi', [AsesiController::class, 'index'])->name('asesi.index');
Route::post('asesi/store', [AsesiController::class, 'store'])->name('asesi.store');

// ################################ Pendaftaraan TUK
Route::get('tuk', [TUKController::class, 'index'])->name('tuk.index');
Route::post('tuk/added', [TUKController::class, 'added'])->name('tuk.added');

// ################################ Data Pegawai
Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('pegawaiAdmin', [PegawaiController::class, 'list'])->name('pegawai.list');
Route::post('pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');

require __DIR__ . '/auth.php';
