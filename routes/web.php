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
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/ajax/skema-by-lsp/{lspRef}', [SkemaController::class, 'getByLsp'])->name('ajax.skema.by-lsp');
Route::get('/ajax/lsp-by-kegiatan/{kegiatan}', [AsesiController::class, 'getLspByKegiatan']);
Route::get('/ajax/jadwal-by-lsp', [AsesiController::class, 'getJadwalByLsp']);
Route::get('/ajax/getJabatanByDepartemen/{departemenNama}', [JabatanController::class, 'getJabatanByDepartemen']);

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
    Route::post('kegiatan/sertifikatUpdate', [KegiatanController::class, 'sertifikatUpdate'])->name('kegiatan.sertifikatUpdate');
    Route::post('kegiatan/uploadSertifikat', [KegiatanController::class, 'uploadSertifikat'])->name('kegiatan.uploadSertifikat');
    Route::post('kegiatan/uploadBuktiAsesmen', [KegiatanController::class, 'uploadBuktiAsesmen'])->name('kegiatan.uploadBuktiAsesmen');
    Route::post('kegiatan/uploadDokumentasiAsesmen', [KegiatanController::class, 'uploadDokumentasiAsesmen'])->name('kegiatan.uploadDokumentasiAsesmen');
    Route::post('kegiatan/uploadLaporanAsesmen', [KegiatanController::class, 'uploadLaporanAsesmen'])->name('kegiatan.uploadLaporanAsesmen');
    Route::post('kegiatan/uploadBuktiTerimaSertifikat', [KegiatanController::class, 'uploadBuktiTerimaSertifikat'])->name('kegiatan.uploadBuktiTerimaSertifikat');

    Route::get('asesmen/create/{id}', [AsesmenController::class, 'create'])->name('asesmen.create');
    Route::post('asesment', [AsesmenController::class, 'store'])->name('asesmen.store');
    Route::delete('asesmen/{id}', [AsesmenController::class, 'destroy'])->name('asesmen.destroy');
    Route::put('/asesmen/{ref}', [AsesmenController::class, 'update'])->name('asesmen.update');


    // ################################ LSP
    Route::post('lsp/change-password/{id}', [LSPController::class, 'changePassword'])->name('lsp.change-password');
    Route::get('lsp', [LSPController::class, 'index'])->name('lsp.index')->middleware('role:dinas,master');
    Route::get('lsp/create', [LSPController::class, 'create'])->name('lsp.create')->middleware('role:dinas,master');
    Route::post('lsp/store', [LSPController::class, 'store'])->name('lsp.store')->middleware('role:dinas,master');
    Route::put('lsp/{id}', [LSPController::class, 'update'])->name('lsp.update')->middleware('role:dinas,master');
    Route::get('lsp/{id}', [LSPController::class, 'show'])->name('lsp.show')->middleware('role:dinas,master');
    Route::delete('lsp/{id}', [LSPController::class, 'destroy'])->name('lsp.destroy')->middleware('role:dinas,master');

    // ################################ Kegiatan LSP
    Route::post('kegiatan-detail', [KegiatanLSPController::class, 'store'])->name('kegiatan-lsp.store')->middleware('role:dinas,master');

    // ################################ Departemen
    Route::get('departemen', [DepartemenController::class, 'index'])->name('departemen.index')->middleware('role:dinas,master');
    Route::post('departemen/store', [DepartemenController::class, 'store'])->name('departemen.store')->middleware('role:dinas,master');
    Route::get('departemen/{id}', [DepartemenController::class, 'edit'])->name('departemen.edit')->middleware('role:dinas,master');
    Route::put('departemen/{id}', [DepartemenController::class, 'update'])->name('departemen.update')->middleware('role:dinas,master');
    Route::delete('departemen/{id}', [DepartemenController::class, 'destroy'])->name('departemen.destroy')->middleware('role:dinas,master');

    // ################################ Jabatan
    Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan.index')->middleware('role:dinas,master');
    Route::post('jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store')->middleware('role:dinas,master');
    Route::get('jabatan/{id}', [JabatanController::class, 'edit'])->name('jabatan.edit')->middleware('role:dinas,master');
    Route::put('jabatan/{id}', [JabatanController::class, 'update'])->name('jabatan.update')->middleware('role:dinas,master');
    Route::delete('jabatan/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy')->middleware('role:dinas,master');

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



    // ################################ Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
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
    Route::put('asesiAdmin/{id}', [AsesiController::class, 'update'])->name('asesiAdmin.update');
    Route::delete('asesiAdmin/{id}', [AsesiController::class, 'destroy'])->name('asesiAdmin.destroy');



    // ################################ User Management
    Route::resource('/user-management', UserManagementController::class)->except(['show', 'edit', 'create'])->middleware('role:dinas,master');
});

// ################################ Generate PDF
Route::get('daftar-hadir/{id}', [PDFController::class, 'daftarHadir'])->name('pdf.daftar-hadir');
Route::get('daftar-penerimaan/{id}', [PDFController::class, 'daftarPenerimaan'])->name('pdf.daftar-penerimaan');
Route::get('tanda-terima-sertifikat/{id}', [PDFController::class, 'tandaTerimaSertifikat'])->name('pdf.tanda-terima-sertifikat');

// ################################ Protected File Access
Route::get('files/asesi/ktp/{filename}', [FileController::class, 'getKTPAsesi'])->name('files.asesi.ktp');
Route::get('files/asesi/ijazah/{filename}', [FileController::class, 'getIjazahAsesi'])->name('files.asesi.ijazah');
Route::get('files/asesi/sertikom/{filename}', [FileController::class, 'getSertikomAsesi'])->name('files.asesi.sertikom');
Route::get('files/asesi/skb/{filename}', [FileController::class, 'getSkbAsesi'])->name('files.asesi.skb');
Route::get('files/asesi/pasfoto/{filename}', [FileController::class, 'getPasFotoAsesi'])->name('files.asesi.pasfoto');
Route::get('files/asesi/sertifikat/{filename}', [FileController::class, 'getSertifikatAsesi'])->name('files.asesi.sertifikat');

Route::get('files/asesmen/bukti_asesmen/{filename}', [FileController::class, 'getBuktiAsesmen'])->name('files.asesmen.bukti_asesmen');
Route::get('files/asesmen/dokumentasi_asesmen/{filename}', [FileController::class, 'getDokumentasiAsesmen'])->name('files.asesmen.dokumentasi_asesmen');
Route::get('files/asesmen/bukti_terima_sertifikat/{filename}', [FileController::class, 'getBuktiTerimaSertifikat'])->name('files.asesmen.bukti_terima_sertifikat');
Route::get('files/asesmen/laporan_asesmen/{filename}', [FileController::class, 'getLaporanAsesmen'])->name('files.asesmen.laporan_asesmen');

// Route::get('files/asesmen/{filename}', [FileController::class, 'serveAsesmenFile'])->name('files.asesmen');
Route::get('files/pegawai/{filename}', [FileController::class, 'servePegawaiFile'])->name('files.pegawai');



// ################################ Pendaftaraan Asesi
Route::get('asesi', [AsesiController::class, 'index'])->name('asesi.index');
Route::post('asesi/store', [AsesiController::class, 'store'])->name('asesi.store');
Route::post('tuk/added', [TUKController::class, 'added'])->name('tuk.added');

// ################################ Data Pegawai
Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('pegawaiAdmin', [PegawaiController::class, 'list'])->name('pegawai.list');
Route::post('pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::put('pegawaiAdmin/{ref}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('pegawaiAdmin/{ref}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');


// Route untuk command terminal
Route::post('/command/migrate', function (Illuminate\Http\Request $request) {

    // if (!Auth::check()) {
    //     abort(403, 'Anda tidak memiliki akses');
    // }
    if ($request->query('key') !== config('app.deploy_key')) {
        abort(403, 'Unauthorized');
    }
    $cmd = 'cd /home/satuproj/pemkab.satuproject.web.id/sertifikasi-pemkab-badung/ && php artisan migrate:fresh 2>&1';
    // $cmd = 'cd ~/Documents/Project/sertifikasi-pemkab-badung/ && php artisan migrate:fresh --seed 2>&1';

    $output = shell_exec($cmd);

    return "<pre>$output</pre>";
})->withoutMiddleware([
    \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
]);

Route::post('/command/pull', function (Illuminate\Http\Request $request) {

    // if (!Auth::check()) {
    //     abort(403, 'Anda tidak memiliki akses');
    // }
    if ($request->query('key') !== config('app.deploy_key')) {
        abort(403, 'Unauthorized');
    }
    $cmd = 'cd /home/satuproj/pemkab.satuproject.web.id/sertifikasi-pemkab-badung/ && git pull 2>&1';
    // $cmd = 'cd ~/Documents/Project/sertifikasi-pemkab-badung/ && git pull 2>&1';

    $output = shell_exec($cmd);

    return "<pre>$output</pre>";
})->withoutMiddleware([
    \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
]);

Route::post('/command/seed', function (Illuminate\Http\Request $request) {

    // if (!Auth::check()) {
    //     abort(403, 'Anda tidak memiliki akses');
    // }
    if ($request->query('className') !== config('app.deploy_key')) {
        abort(403, 'Unauthorized');
    }
    $cmd = 'cd /home/satuproj/pemkab.satuproject.web.id/sertifikasi-pemkab-badung/ && php artisan db:seed --class=' . $request->query('className') . ' 2>&1';
    // $cmd = 'cd ~/Documents/Project/sertifikasi-pemkab-badung/ && git pull 2>&1';

    $output = shell_exec($cmd);

    return "<pre>$output</pre>";
})->withoutMiddleware([
    \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
]);


require __DIR__ . '/auth.php';
