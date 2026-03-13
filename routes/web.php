<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Root\CommonController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Models\About;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $about = About::where('id',1)->first();
    return view('theme.index',compact('about'));
})->name('home');

//--------------------Auth Route-----------------------------------------
Route::get('auth/login',[AuthController::class,'AdminLogin'])->name('login');

Route::post('auth/verify',[AuthController::class,'AdminLoginPost'])->name('admin.verify');

Route::get('auth/logout',[AuthController::class,'AdminLogout'])->name('admin.logout');

Route::get('auth/reset-password',[AuthController::class,'resetPassword'])->name('auth.otp.send');

Route::post('auth/verify/email',[AuthController::class,'Forget_Password_OTP'])->name('auth.verify.email');

Route::post('auth/otp/verify',[AuthController::class,'OTP_Verify'])->name('auth.verify.otp');

//--------------------Frontend Routes-----------------------------------------

Route::get('tour-list',[CommonController::class,'TourList'])->name('front.tour-list');

Route::get('tour-details/{id}',[CommonController::class,'TourDetails'])->name('front.tour.detail');

Route::get('contact',[CommonController::class,'Contact'])->name('front.contact');
Route::get('login',[CommonController::class,'Login'])->name('front.login');

Route::get('pricing',[CommonController::class,'Pricing'])->name('front.pricing');

Route::get('faq',[CommonController::class,'Faq'])->name('front.faq');

Route::get('about-us',[CommonController::class,'About'])->name('front.about');

Route::post('about-us/store',[CommonController::class,'ContactForm'])->name('front.contact.store');

Route::get('gallery',[CommonController::class,'gallery'])->name('front.gallery');

//------------------- SSLCOMMERZ Start------------------------------------------

Route::post('sslcommerz/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');

Route::post('sslcommerz/buy/plan', [SslCommerzPaymentController::class, 'BuyPlan'])->name('buy.plan');

Route::post('sslcommerz/success', [SslCommerzPaymentController::class, 'success']);

Route::post('sslcommerz/fail', [SslCommerzPaymentController::class, 'fail']);

Route::post('sslcommerz/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('sslcommerz/ipn', [SslCommerzPaymentController::class, 'ipn']);

//-------------------- SSLCOMMERZ END --------------------------------

