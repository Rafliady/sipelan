<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicSurveyController;
use App\Http\Controllers\AuthController;

// --- PUBLIC ---
Route::get('/', [PublicSurveyController::class, 'index'])->name('home');
Route::post('/enter', [PublicSurveyController::class, 'enter'])->name('public.enter');
Route::get('/daftar-pegawai', [PublicSurveyController::class, 'list'])->name('public.list');
Route::get('/survey/{id}', [PublicSurveyController::class, 'showSurvey'])->name('public.survey');
Route::post('/survey', [PublicSurveyController::class, 'storeSurvey'])->name('survey.store');
Route::post('/exit', [PublicSurveyController::class, 'exit'])->name('public.exit');

// --- AUTH ---
Route::get('/admin/login', function () { return view('admin.login'); })->name('login');
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('admin.auth');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// --- ADMIN PANEL ---
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // 2. Kelola Pegawai (CRUD)
    Route::get('/pegawai', [AdminController::class, 'employeeIndex'])->name('admin.employees');
    Route::post('/pegawai', [AdminController::class, 'employeeStore'])->name('admin.employees.store');
    Route::put('/pegawai/{id}', [AdminController::class, 'employeeUpdate'])->name('admin.employees.update');
    Route::delete('/pegawai/{id}', [AdminController::class, 'employeeDestroy'])->name('admin.employees.destroy');

    // 3. Riwayat Survey (Edit/Hapus Hasil)
    Route::get('/riwayat', [AdminController::class, 'historyIndex'])->name('admin.history');
    Route::delete('/riwayat/{id}', [AdminController::class, 'historyDestroy'])->name('admin.history.destroy');
    // (Opsional: Edit Riwayat jika survey salah input)
    Route::put('/riwayat/{id}', [AdminController::class, 'historyUpdate'])->name('admin.history.update');

    // 4. Ranking & Reset
    Route::get('/ranking', [AdminController::class, 'rankingIndex'])->name('admin.ranking');
    Route::delete('/ranking/reset', [AdminController::class, 'rankingReset'])->name('admin.ranking.reset');

    // Menu Ranking (Sudah ada, tapi tambah export)
    Route::get('/ranking', [AdminController::class, 'rankingIndex'])->name('admin.ranking');
    Route::delete('/ranking/reset', [AdminController::class, 'rankingReset'])->name('admin.ranking.reset');
    
    // Route Export Baru
    Route::get('/ranking/pdf', [AdminController::class, 'exportPdf'])->name('admin.ranking.pdf');
    Route::get('/ranking/excel', [AdminController::class, 'exportExcel'])->name('admin.ranking.excel');

    // Menu Pengaturan Background
    Route::get('/pengaturan', [AdminController::class, 'settingIndex'])->name('admin.settings');
    Route::post('/pengaturan', [AdminController::class, 'settingUpdate'])->name('admin.settings.update');

});

