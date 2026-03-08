<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('theme.index');
});

//--------------------Admin Login Route-----------------------------------------
Route::get('auth/login',[AuthController::class,'AdminLogin'])->name('admin.login');

Route::post('auth/verify',[AuthController::class,'AdminLoginPost'])->name('admin.verify');

Route::get('auth/logout',[AuthController::class,'AdminLogout'])->name('admin.logout');




//------------------- SSLCOMMERZ Start------------------------------------------

Route::post('sslcommerz/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');

Route::post('sslcommerz/success', [SslCommerzPaymentController::class, 'success']);

Route::post('sslcommerz/fail', [SslCommerzPaymentController::class, 'fail']);

Route::post('sslcommerz/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('sslcommerz/ipn', [SslCommerzPaymentController::class, 'ipn']);

//-------------------- SSLCOMMERZ END --------------------------------

