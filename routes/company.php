<?php

use App\Http\Controllers\Company\PackageController;
use App\Http\Controllers\Company\SubscriptionController;

Route::get('dashboard',function (){
    return view('admin.dashboard');
})->name('dashboard');


Route::get('subscription',[SubscriptionController::class,'index'])->name('subscription.index');

Route::get('package',[PackageController::class,'index'])->name('package.index');


Route::get('package/create',[PackageController::class,'create'])->name('package.create');
