<?php

use App\Http\Controllers\Company\PackageController;
use App\Http\Controllers\Company\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',function (){
    return view('admin.dashboard');
})->name('dashboard');


Route::get('subscription',[SubscriptionController::class,'index'])->name('subscription.index');


/*
========================================================================
                            Package Route
========================================================================
*/

Route::get('package',[PackageController::class,'index'])->name('package.index');


Route::get('package/create',[PackageController::class,'create'])->name('package.create');

Route::get('package/getState',[PackageController::class,'getState'])->name('package.getstate');

Route::post('package/store',[PackageController::class,'store'])->name('package.store');