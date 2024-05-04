<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Verifikator\VerifikatorController;
use Illuminate\Support\Facades\Route;
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


// Login
Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


// routes/web.php

Route::group(['middleware' => 'auth'], function () {
    // Route untuk dashboard admin
    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [
            AdminController::class, 'index'
        ])->name('admin.dashboard');
        // Route untuk menampilkan form transaksi
        Route::get('/rekap', [RekapController::class, 'index'])->name('admin.rekap');
        Route::post('/rekap/export', [RekapController::class, 'export'])->name('rekap.export');
    });

    // Route untuk dashboard verifikator
    Route::prefix('verifikator')->middleware(['auth', 'verifikator'])->group(function () {
        Route::get('/dashboard', [VerifikatorController::class, 'index'])->name('verifikator.dashboard');
        Route::patch('/verifikator/transaksi/{id}/verifikasi', [VerifikatorController::class, 'verifikasi'])->name('verifikator.transaksi.verifikasi');
    });

    // Route untuk dashboard user
    Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
        Route::get('/transaksi', [UserController::class, 'transaksi'])->name('user.transaksi');
        // Route untuk menyimpan data transaksi
        Route::post('/transaksi', [UserController::class, 'store'])->name('user.transaksi.store');
    });
});
