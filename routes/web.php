<?php

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

Route::get('/dashboard', function () {
    return view('admin-panel.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
