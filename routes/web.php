<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/pendaftaran');
});



Route::view('/pendaftaran', 'pendaftaran')->name('pendaftaran');

Route::get('/login', [App\Http\Controllers\LoginController:: class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\LoginController:: class, 'authenticate'])->name('authenticate');
Route::get('/logout', [App\Http\Controllers\LoginController:: class, 'logout'])->name('logout');

Route::post('/pendaftaran', [\App\Http\Controllers\PendaftaranController::class, 'daftar'])->name('daftar');



Route::middleware(['auth'])->group(function () {
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
        
        Route::get('/siswa', [\App\Http\Controllers\Admin\SiswaController::class, 'index'])->name('siswa');
        Route::get('/siswa/lihat/{id}', [\App\Http\Controllers\Admin\SiswaController::class, 'lihat'])->name('siswa.lihat');
        Route::delete('/siswa/hapus/{id}', [\App\Http\Controllers\Admin\SiswaController::class, 'destroy'])->name('siswa.hapus');
        Route::get('/siswa/diterima/{id}', [\App\Http\Controllers\Admin\SiswaController::class, 'diterima'])->name('siswa.diterima');
        Route::get('/siswa/ditolak/{id}', [\App\Http\Controllers\Admin\SiswaController::class, 'ditolak'])->name('siswa.ditolak');
    
        Route::post('/siswa/import', [\App\Http\Controllers\Admin\SiswaController::class, 'import'])->name('siswa.import');
        Route::get('/siswa/export', [\App\Http\Controllers\Admin\SiswaController::class, 'export'])->name('siswa.export');
        Route::get('/siswa/pdf', [\App\Http\Controllers\Admin\SiswaController::class, 'pdf'])->name('siswa.pdf');
    }); 
});