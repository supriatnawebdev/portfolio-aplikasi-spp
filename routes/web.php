<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\AuthSiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AdminBerandaController;
use App\Http\Controllers\BerandaSiswaController;
use App\Http\Controllers\DataSiswa\DataSiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('administrator')->group(function () {

    Route::get('/beranda', [AdminBerandaController::class, 'index'])->name('administrator.beranda');
    Route::resource('user', UserController::class);
    Route::resource('siswas', SiswaController::class);
    Route::resource('spp', SppController::class);
    Route::resource('tagihan', TagihanController::class);
    Route::resource('pembayaran', PembayaranController::class);
});

Route::get('/siswa', [AuthSiswaController::class, 'showForm'])->name('show.login');
Route::post('siswa/login', [AuthSiswaController::class, 'checkLogin'])->name('siswa.login');
Route::get('/siswa/beranda', [BerandaSiswaController::class, 'index' ])->name('siswa.beranda');
Route::get('/siswa/dashboard', [DataSiswaController::class, 'index'])->name('siswa.index');
