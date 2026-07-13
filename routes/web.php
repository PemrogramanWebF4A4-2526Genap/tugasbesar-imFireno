<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RatingController;
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

// Verification routes (accessible without auth for login OTP)
Route::get('/verify', [VerificationController::class, 'index']);
Route::post('/verify', [VerificationController::class, 'store']);
Route::get('/verify/{unique_id}', [VerificationController::class, 'show']);
Route::put('/verify/{unique_id}', [VerificationController::class, 'update']);

// Midtrans Callback
Route::post('/api/midtrans/callback', [\App\Http\Controllers\Api\MidtransController::class, 'callback']);
Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::view('/dashboard/user', 'admin.user.index')->name('admin.user');
    Route::view('/dashboard/kategori', 'admin.kategori.index')->name('admin.kategori');
    Route::view('/dashboard/transaksi', 'admin.transaksi.index')->name('admin.transaksi');
    Route::get('/dashboard/laporan', function() {
        return view('admin.laporan.index');
    })->name('admin.laporan');
    Route::view('/dashboard', 'admin.dashboard.index')->name('admin.dashboard');
});
Route::group(['middleware' => ['auth', 'check_role:pembeli', 'check_status']], function () {
    Route::view('/home', 'pembeli.home.index')->name('pembeli.home');
    Route::view('/keranjang', 'pembeli.keranjang.index')->name('pembeli.keranjang');
    Route::view('/checkout', 'pembeli.checkout.index')->name('pembeli.checkout');
    Route::view('/pembayaran', 'pembeli.pembayaran.index')->name('pembeli.pembayaran');
    Route::view('/pesanan', 'pembeli.pesanan.index')->name('pembeli.pesanan');
    Route::view('/kategori', 'pembeli.kategori.index')->name('pembeli.kategori');
    Route::get('/pesanan/{order}/invoice/view', [InvoiceController::class, 'view'])->name('pembeli.invoice.view');
    Route::get('/pesanan/{order}/invoice/download', [InvoiceController::class, 'download'])->name('pembeli.invoice.download');
    
    // Rating routes
    Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');
    Route::put('/rating/{id}', [RatingController::class, 'update'])->name('rating.update');
    Route::delete('/rating/{id}', [RatingController::class, 'destroy'])->name('rating.destroy');
});

Route::group(['middleware' => ['auth', 'check_role:penjual', 'check_status']], function () {
    Route::view('/seller/dashboard', 'seller.dashboard.index')->name('seller.dashboard');
    Route::view('/seller/jasa', 'seller.jasa.index')->name('seller.jasa');
    Route::view('/seller/pesanan', 'seller.pesanan.index')->name('seller.pesanan');
    
    // Service CRUD Routes
    Route::view('/seller/service', 'seller.service.index')->name('seller.service.index');
    Route::view('/seller/service/create', 'seller.service.create')->name('seller.service.create');
    Route::view('/seller/service/{id}/edit', 'seller.service.edit')->name('seller.service.edit');
    
    // Laporan Route
    Route::view('/seller/laporan', 'seller.laporan.index')->name('seller.laporan');
});