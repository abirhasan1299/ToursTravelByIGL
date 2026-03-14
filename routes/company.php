<?php

use App\Http\Controllers\Company\BookingController;
use App\Http\Controllers\Company\PackageController;
use App\Http\Controllers\Company\SubscriptionController;
use App\Http\Controllers\Company\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',function (){
    return view('admin.dashboard');
})->name('dashboard');


Route::get('subscription',[SubscriptionController::class,'index'])->name('subscription.index');

/*
========================================================================
                            Booking  Route
========================================================================
*/

Route::get('booking',[BookingController::class,'index'])->name('booking');

Route::get('booking/data/{id}',[BookingController::class,'EditStatus'])->name('booking.info');

Route::put('booking/update/{id}',[BookingController::class,'UpdateStatus'])->name('booking.update.status');

/*
========================================================================
                            Package Route
========================================================================
*/

Route::get('package',[PackageController::class,'index'])->name('package.index');


Route::get('package/create',[PackageController::class,'create'])->name('package.create');

Route::get('package/getState',[PackageController::class,'getState'])->name('package.getstate');

Route::post('package/store',[PackageController::class,'store'])->name('package.store');

Route::get('package/activity/{id}',[PackageController::class,'Activity'])->name('package.activity');

Route::post('package/activity/store',[PackageController::class,'ActivityStore'])->name('package.activity.store');

Route::delete('package/activity/destroy/{id}',[PackageController::class,'destroy'])->name('package.activity.destroy');

/*
========================================================================
                            Package Booking Route
========================================================================
*/

Route::post('package/credit/plan',[PackageController::class,'BuyWithCredit'])->name('package.buy.with.credit');

/*
========================================================================
                            Transaction Route
========================================================================
*/
Route::get('transaction/history',[TransactionController::class,'index'])->name('transaction');


