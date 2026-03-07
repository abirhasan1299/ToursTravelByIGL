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


Route::middleware(['payment'])->group(function () {
//------------------- SSLCOMMERZ Start---------------------------

Route::match(['get','post'],'pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::match(['get','post'],'pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::match(['get','post'],'success', [SslCommerzPaymentController::class, 'success']);
Route::match(['get','post'],'fail', [SslCommerzPaymentController::class, 'fail']);
Route::match(['get','post'],'cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::match(['get','post'],'ipn', [SslCommerzPaymentController::class, 'ipn']);

//-------------------- SSLCOMMERZ END --------------------------------
});

