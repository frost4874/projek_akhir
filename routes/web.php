<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\pemohon\BerandaController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DataMasyarakatController;
use App\Http\Controllers\admin\BerkasPermohonanController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\PejabatDesaController;
use App\Http\Controllers\admin\BiodataDesaController;
use App\Http\Controllers\master\DashboardMasterController;
use App\Http\Controllers\master\DataDesaController;
use App\Http\Controllers\master\TemplateSuratController;
use App\Http\Controllers\master\LaporanMasterController;
use App\Http\Controllers\KecamatanDesaController;
use App\Http\Controllers\auth\LogoutController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'login']); //route post untuk login
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/register', [RegisterController::class, 'register'])->name('register'); //route post untuk register
Route::get('/register', [RegisterController::class, 'index']);

Route::get('/kecamatan', [KecamatanDesaController::class, 'getKecamatan']);
Route::get('/desa/{id_kec}', [KecamatanDesaController::class, 'getDesaByKecamatan']);

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth:biodata');
Route::middleware(['auth:biodata', 'check.role'])->group(function () {
    Route::get('/dashboard_master', [DashboardMasterController::class, 'index'])->name('admin.dashboard_master');
    Route::get('/dashboard_master/{id_berkas}/{judul_berkas}', [DashboardMasterController::class, ''])->name('master.request');
    Route::get('/data_admindesa', [DataDesaController::class, 'index'])->name('admin.data_admindesa');
    Route::post('/data_admindesa', [DataDesaController::class, 'tambah'])->name('register.desa');
    Route::put('/data_admindesa/{nik}', [DataDesaController::class, 'update'])->name('master.update.desa');
    Route::delete('/data_admindesa/{nik}', [DataDesaController::class, 'destroy'])->name('master.delete.desa');

    Route::get('/templatesurat', [TemplateSuratController::class, 'index'])->name('admin.templatesurat');
    Route::get('/templatesurat/tambah', [TemplateSuratController::class, 'tambahSurat'])->name('admin.tambahsurat');
    Route::get('/templatesurat/edit/{id_berkas}', [TemplateSuratController::class, 'editSurat'])->name('admin.editsurat');
    Route::put('/templatesurat/{id_berkas}', [TemplateSuratController::class, 'update'])->name('templatesurat.update');
    Route::post('/templatesurat/store', [TemplateSuratController::class, 'store'])->name('berkas.store');
    Route::delete('/templatesurat/{judul_berkas}/delete', [TemplateSuratController::class, 'destroy'])->name('berkas.delete');
    Route::get('/laporan_master', [LaporanMasterController::class, 'index'])->name('admin.laporan_master');
    Route::get('/biodata_master', [DashboardMasterController::class, 'master'])->name('admin.biodata_master');
    Route::get('/biodata_master/{nik}', [DashboardMasterController::class, 'ubah'])->name('ubah.master');
    Route::put('/biodata_master/{nik}', [DashboardMasterController::class, 'update'])->name('update.master');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
Route::middleware(['auth:biodata', 'adminDesa'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/dashboard/{id_berkas}/{judul_berkas}', [DashboardController::class, 'adminRequest'])->name('admin.request');
    Route::post('/dashboard/request', [DashboardController::class, 'tambahRequest'])->name('tambah.request');
    Route::put('/request/{id_request}/acc', [DashboardController::class, 'accRequest'])->name('request.acc');
    Route::post('/request/{id_request}/cetak', [DashboardController::class, 'viewCetak'])->name('print.cetak');
    Route::get('/request/{id_request}/review', [DashboardController::class, 'reviewCetak'])->name('cetak.review');
    Route::get('/request/{id_request}/print', [DashboardController::class, 'printCetak'])->name('cetak.print');

    Route::get('/request/{nik}/{id_request}/{id_berkas}/{judul_berkas}/edit', [DashboardController::class, 'edit'])->name('detail.request');
    Route::get('/request/{id_request}/edit', [DashboardController::class, 'edit'])->name('request.edit');
    Route::put('/admin/request/update', [DashboardController::class, 'update'])->name('request.update');
    Route::get('/data_masyarakat', [DataMasyarakatController::class, 'index'])->name('admin.data_masyarakat');
    Route::get('/data_masyarakat/{nik}/edit', [DataMasyarakatController::class, 'edit'])->name('masyarakat.edit');
    Route::put('/data_masyarakat/{nik}', [DataMasyarakatController::class, 'update'])->name('masyarakat.update');
    Route::delete('/data_masyarakat/{nik}', [DataMasyarakatController::class, 'destroy'])->name('masyarakat.delete');
    Route::post('/register_masyarakat', [DataMasyarakatController::class, 'register'])->name('register.masyarakat');
    Route::get('/berkas_permohonan', [BerkasPermohonanController::class, 'index'])->name('admin.berkas_permohonan');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/laporan/cetakpdf', [LaporanController::class, 'cetak_pdf']);
    Route::get('/laporan/print', [LaporanController::class, 'print']);

    Route::get('/biodata_desa', [BiodataDesaController::class, 'index'])->name('admin.biodata_desa');
    Route::get('/biodata_desa/{nik}', [BiodataDesaController::class, 'ubah'])->name('ubah.desa');
    Route::put('/biodata_desa/{nik}', [BiodataDesaController::class, 'update'])->name('biodata.update');
    Route::get('/pejabat', [PejabatDesaController::class, 'index'])->name('admin.pejabat_desa');
    Route::post('/pejabat', [PejabatDesaController::class, 'store'])->name('pejabat.store');
    Route::get('/pejabat/{nip}/edit', [PejabatDesaController::class, 'edit'])->name('pejabat.edit');
    Route::put('/pejabat/{nip}', [PejabatDesaController::class, 'update'])->name('pejabat.update');
    Route::delete('/pejabat/{nip}', [PejabatDesaController::class, 'destroy'])->name('pejabat.destroy');

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
Route::middleware(['auth:biodata', 'isPemohon'])->group(function(){
    Route::get('/beranda', [BerandaController::class, 'index'])->name('pemohon.dashboard');
    Route::get('/request/{id_berkas}/{judul_berkas}', [BerandaController::class, 'newRequest'])->name('user.request');
    Route::post('/request', [BerandaController::class, 'tambahRequest'])->name('user.tambah.request');
});
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/ckeditor', [TemplateSuratController::class, 'showCKEditor']);