<?php

use App\Http\Controllers\Root\CompanyInfo;
use App\Http\Controllers\Root\FaqController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Root\CompanyController;
use App\Http\Controllers\Root\PackageController;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

/*
    |--------------------------------------------------------------------------
    | FAQ's Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('faqs',[FaqController::class,'index'])->name('faqs');

Route::post('faqs/store',[FaqController::class,'store'])->name('faqs.store');

Route::get('faqs/edit/{id}',[FaqController::class,'edit'])->name('faqs.edit');

Route::put('faqs/update/{id}',[FaqController::class,'update'])->name('faqs.update');

Route::delete('faqs/destroy/{id}',[FaqController::class,'destroy'])->name('faqs.destroy');

/*
    |--------------------------------------------------------------------------
    | Website Informations Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('/about',[CompanyInfo::class,'index'])->name('about');

Route::post('/about/store',[CompanyInfo::class,'store'])->name('about.store');

Route::get('/settings',[CompanyInfo::class,'setting'])->name('setting');

Route::post('/settings/store',[CompanyInfo::class,'StoreSetting'])->name('setting.store');

/*
    |--------------------------------------------------------------------------
    | Comapany Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('/create-company',[CompanyController::class,'createCompany'])->name('create-company');

Route::get('/list-company',[CompanyController::class,'listCompany'])->name('list-company');

Route::post('/store-company',[CompanyController::class,'store'])->name('store-company');

/*
    |--------------------------------------------------------------------------
    | Package Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('/package',[PackageController::class,'index'])->name('package.index');

Route::post('/package/store',[PackageController::class,'store'])->name('package.store');

Route::post('/package/edit/{id}',[PackageController::class,'updatePackage'])->name('package.update');

Route::delete('/package/destroy/{id}',[PackageController::class,'destory'])->name('package.destroy');

Route::get('/package/getData/{id}',[PackageController::class,'getData'])->name('package.getdata');
