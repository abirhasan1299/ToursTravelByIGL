<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Root\CompanyController;
use App\Http\Controllers\Root\PackageController;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');
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
