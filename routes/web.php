<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DataUktController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\FolderArsipController;

// Route Mahasiswa
Route::get('/', function () {
    return view('page');
});

Route::get('/login', [LoginController::class, 'formLoginMahasiswa'])->name('mahasiswa.login');
Route::post('/login', [LoginController::class, 'storeLoginMahasiswa'])->name('store.mahasiswa.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth:mahasiswa')->group(function () {
    Route::get('/page', function(){
        return redirect('/');
    })->name('mahasiswa.page');

    Route::get('/home', [HomeController::class, 'homeMahasiswa'])->name('mahasiswa.home');
    Route::get('/data-ukt', [DataUktController::class, 'index'])->name('mahasiswa.data-ukt');
    Route::get('/data-ukt/create', [DataUktController::class, 'create'])->name('data-ukt.create');
    Route::get('/data-ukt/print', [DataUktController::class, 'print'])->name('data-ukt.print');
    Route::post('/data-ukt/store', [DataUktController::class, 'store'])->name('data-ukt.store');
    Route::get('/data-ukt/edit/{id}', [DataUktController::class, 'edit'])->name('data-ukt.edit');
    Route::post('/data-ukt/update/{id}', [DataUktController::class, 'update'])->name('data-ukt.update');
});

// Route Admin
Route::get('/admin/login', [LoginController::class, 'formLoginAdmin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'storeLoginAdmin'])->name('store.admin.login');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin', function () {
        return redirect('/');
    });
    Route::get('/admin/page', function(){
        return redirect ('/');
    })->name('admin.page');

    Route::get('/admin/home', [HomeController::class, 'homeAdmin'])->name('admin.home');
    Route::resource('admin/kriteria',KriteriaController::class);
    Route::resource('admin/sub-kriteria',SubkriteriaController::class);

    Route::resource('admin/mahasiswa',MahasiswaController::class);
    Route::get('admin/mahasiswa-import', [MahasiswaController::class, 'mahasiswaimport'])->name('mahasiswaimport');
    Route::post('admin/mahasiswa-import', [MahasiswaController::class, 'mahasiswaupload'])->name('mahasiswaimportup');
    Route::get('admin/mahasiswa-importsave', [MahasiswaController::class, 'importsave'])->name('mahasiswaimportsave');
    Route::get('admin/mahasiswa-import-batal', [MahasiswaController::class, 'importbatal'])->name('mahasiswaimportbatal');
    Route::get('admin/mahasiswa-export', [MahasiswaController::class, 'mahasiswaexport'])->name('mahasiswaexport');

    Route::resource('admin/jurusan', JurusanController::class);
    Route::resource('admin/prodi', ProdiController::class);
    Route::resource('admin/golongan', GolonganController::class);
    Route::resource('admin/admin', AdminController::class)->middleware('superadmin');
    Route::resource('admin/arsip', ArsipController::class);

    Route::get('admin/folder/{id}', [FolderArsipController::class, 'index'])->name('admin.folderarsip');
    Route::get('admin/folder/edit/{id}', [FolderArsipController::class, 'edit'])->name('admin.DetailFolderArsip');
    Route::post('admin/data-lengkap/arsip', [FolderArsipController::class, 'arsip'])->name('admin.lengkap.arsip');

    Route::get('admin/data-ukt', [DataUktController::class, 'index'])->name('admin.data-ukt');
    Route::get('admin/menunggu-verifikasi', [DataUktController::class, 'verif'])->name('admin.menunggu-verifikasi');
    Route::get('admin/data-belum-lengkap', [DataUktController::class, 'tidaklengkap'])->name('admin.data-belum-lengkap');
    Route::get('admin/data-lengkap', [DataUktController::class, 'lengkap'])->name('admin.data-lengkap');
    Route::get('admin/datauktexport', [DataUktController::class, 'datauktexport'])->name('datauktexport');
    Route::get('admin/data-ukt/edit/{id}', [DataUktController::class, 'edit'])->name('admin.data-ukt.edit');
    Route::post('admin/data-ukt/update/{id}', [DataUktController::class, 'update'])->name('admin.data-ukt.update');
    Route::get('admin/data-ukt/print/{id}', [DataUktController::class, 'print'])->name('admin.data-ukt.print');
    Route::get('admin/data-ukt/printukt', [DataUktController::class, 'printukt'])->name('admin.data-ukt.printukt');


});
Route::get('get-sub-kriteria/{id}',[KriteriaController::class, 'getSubKriteria']);
