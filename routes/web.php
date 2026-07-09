<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerificationController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', fn () => view('auth.login')) -> name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', fn () => view('auth.register')) -> name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::view('/dashboard/user', 'admin.user.index')->name('admin.user');
    Route::view('/dashboard/kategori', 'admin.kategori.index')->name('admin.kategori');
    Route::view('/dashboard/jasa', 'admin.jasa.index')->name('admin.jasa');
    Route::view('/dashboard/pesanan', 'admin.pesanan.index')->name('admin.pesanan');
    Route::view('/dashboard/laporan', 'admin.laporan.index')->name('admin.laporan');
    Route::view('/dashboard/seller', 'admin.seller.index')->name('admin.seller');
    Route::view('/dashboard', 'admin.dashboard.index')->name('admin.dashboard');
});
Route::group(['middleware' => ['auth', 'check_role:pembeli', 'check_status']], function () {
    Route::get('/home', [HomeController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'check_role:penjual']], function () {
    Route::view('/seller/dashboard', 'seller.dashboard.index')->name('seller.dashboard');
    Route::view('/seller/jasa', 'seller.jasa.index')->name('seller.jasa');
    
    // Service CRUD Routes
    Route::view('/seller/service', 'seller.service.index')->name('seller.service.index');
    Route::view('/seller/service/create', 'seller.service.create')->name('seller.service.create');
    Route::view('/seller/service/{id}/edit', 'seller.service.edit')->name('seller.service.edit');
});

Route::group(['middleware' => ['auth', 'check_role:pembeli']], function () {
    Route::get('/verify', [VerificationController::class, 'index'] );
    Route::post('/verify', [VerificationController::class, 'store'] );
    Route::get('/verify/{unique_id}', [VerificationController::class, 'show'] );
    Route::put('/verify/{unique_id}', [VerificationController::class, 'update'] );
});