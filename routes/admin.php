<?php

use App\Http\Controllers\Root\BookingController;
use App\Http\Controllers\Bus\BusController;
use App\Http\Controllers\Root\CompanyInfo;
use App\Http\Controllers\Root\DestinationController;
use App\Http\Controllers\Root\FacilityController;
use App\Http\Controllers\Root\FaqController;
use App\Http\Controllers\Root\GalleryController;
use App\Http\Controllers\Root\PostController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Root\CompanyController;
use App\Http\Controllers\Root\PackageController;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

/*
    |--------------------------------------------------------------------------
    | Bus Routes
    |--------------------------------------------------------------------------
    |
*/
Route::get('bus',[BusController::class,'index'])->name('bus.index');
Route::get('bus/create',[BusController::class,'create'])->name('bus.create');
Route::get('bus/edit/{id}',[BusController::class,'edit'])->name('bus.edit');
Route::put('bus/update/{id}',[BusController::class,'update'])->name('bus.update');
Route::post('bus/store',[BusController::class,'store'])->name('bus.store');
Route::delete('bus/destroy/{id}',[BusController::class,'destroy'])->name('bus.destroy');

/*
    |--------------------------------------------------------------------------
    | Booking Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('booking',[BookingController::class,'index'])->name('booking');

Route::get('booking/data/{id}',[BookingController::class,'EditStatus'])->name('booking.info');

Route::put('booking/update/{id}',[BookingController::class,'UpdateStatus'])->name('booking.update.status');

Route::post('/paid/confirm/{id}',[PostController::class,'CashOnDelivery'])->name('package.confirm');

/*
    |--------------------------------------------------------------------------
    | SEO Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('seo',[SeoController::class,'index'])->name('seo.index');
Route::post('seo/store',[SeoController::class,'store'])->name('seo.store');
Route::get('seo/edit/{id}',[SeoController::class,'edit'])->name('seo.edit');
Route::put('seo/update/{id}',[SeoController::class,'update'])->name('seo.update');
Route::delete('seo/destroy/{id}',[SeoController::class,'destroy'])->name('seo.destroy');



/*
    |--------------------------------------------------------------------------
    | Gallery and Contact Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('gallery',[GalleryController::class,'index'])->name('gallery');

Route::post('gallery/store',[GalleryController::class,'store'])->name('gallery.store');

Route::delete('gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

Route::get('contacts/',[FaqController::class,'ContactList'])->name('contacts.list');

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
    | Website Information Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('/about',[CompanyInfo::class,'index'])->name('about');

Route::post('/about/store',[CompanyInfo::class,'store'])->name('about.store');

Route::get('/settings',[CompanyInfo::class,'setting'])->name('setting');

Route::post('/settings/store',[CompanyInfo::class,'StoreSetting'])->name('setting.store');

/*
    |--------------------------------------------------------------------------
    | Company Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('/create-company',[CompanyController::class,'createCompany'])->name('create-company');

Route::get('/list-company',[CompanyController::class,'listCompany'])->name('list-company');

Route::post('/store-company',[CompanyController::class,'store'])->name('store-company');

Route::get('/users/edit/{id}',[CompanyController::class,'editCompany'])->name('edit-company');

Route::put('/users/update/{id}',[CompanyController::class,'update'])->name('update-company');

Route::delete('/users/delete/{id}',[CompanyController::class,'destroy'])->name('destroy-company');

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

/*
    |--------------------------------------------------------------------------
    | Post Routes
    |--------------------------------------------------------------------------
    |
*/

Route::get('/post/',[PostController::class,'index'])->name('post.index');

Route::get('/post/activity/{id}',[PostController::class,'Activity'])->name('post.activity');

Route::post('/post/activity/store',[PostController::class,'ActivityStore'])->name('post.activity.store');




Route::get('/post/create',[PostController::class,'create'])->name('post.create');

Route::post('/post/store',[PostController::class,'store'])->name('post.store');

Route::get('/post/verify/{id}',[PostController::class,'show'])->name('post.show');

Route::get('/post/active/{id}',[PostController::class,'ActivateStatus'])->name('post.active');

Route::get('/post/suspend/{id}',[PostController::class,'SuspendedStatus'])->name('post.suspend');

Route::delete('/post/destroy/{id}',[PostController::class,'destroy'])->name('post.destroy');

Route::get('/post/persons/{id}',[PostController::class,'persons'])->name('post.persons');

Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('post/update/{id}', [PostController::class, 'update'])->name('post.update');


/*
    |--------------------------------------------------------------------------
    | HOTEL Facility
    |--------------------------------------------------------------------------
    |
*/

Route::get('/facility/',[FacilityController::class,'index'])->name('facility.index');

Route::post('/facility/store',[FacilityController::class,'store'])->name('facility.store');

Route::delete('/facility/destroy/{id}',[FacilityController::class,'destroy'])->name('facility.destroy');

/**
    |--------------------------------------------------------------------------
    | Destination Controller
    |--------------------------------------------------------------------------
    |
*/

Route::get('/destination',[DestinationController::class,'index'])->name('des.index');

Route::get('/destination/create',[DestinationController::class,'create'])->name('des.create');

Route::post('/destination/store',[DestinationController::class,'store'])->name('des.store');

Route::get('/destination/edit/{id}',[DestinationController::class,'edit'])->name('des.edit');

Route::put('/destination/update/{id}',[DestinationController::class,'update'])->name('des.update');

Route::delete('/destination/destroy/{id}',[DestinationController::class,'destroy'])->name('des.destroy');

