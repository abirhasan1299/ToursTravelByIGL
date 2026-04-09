<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Root\CommonController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\UserBooking;
use App\Models\About;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Seo;
use Illuminate\Support\Facades\Route;

Route::middleware('bot')->group(function () {

    Route::get('/', function () {

        $about = About::where('id',1)->first();
        $seo = Seo::where('page_name','/')->first();

        $startLocations = Package::select('start_location','end_location')
                        ->distinct()
                        ->get();

        $tourTypes = Package::select('tour_type')
                    ->distinct()
                    ->pluck('tour_type');

        $hotelLocations = Hotel::distinct()->pluck('location')->toArray();

        $tours = Package::inRandomOrder()->limit(3)->get();

        return view('theme.index',compact('about','startLocations','tourTypes','hotelLocations','seo','tours'));

    })->name('home');

    Route::get('/404', function () {
        return view('theme.404');
    })->name('404');

//-------------------Google Route---------------------------------------------------
    Route::controller(SocialiteController::class)->group(function () {

        Route::get('/google/auth','googleLogin')->name('google.auth');

        Route::get('/google/callback','googleCallback')->name('google.callback');

        Route::get('/github/auth','redirect')->name('github.auth');

        Route::get('/github/callback','callback')->name('github.callback');
    });




//--------------------Package Booking Route-----------------------------------------
    Route::post('package/store',[UserBooking::class,'BookingRequest'])->name('package.booking');

    Route::get('package/verify/otp',[UserBooking::class,'verificationBooking'])->name('package.otp');

    Route::post('package/verify/otp/check',[UserBooking::class,'OTP_Verify'])->name('package.otp.verify');

//--------------------Auth Route----------------------------------------------------
    Route::get('auth/login',[AuthController::class,'AdminLogin'])->name('login');

    Route::post('auth/verify',[AuthController::class,'AdminLoginPost'])->name('admin.verify');

    Route::get('auth/logout',[AuthController::class,'AdminLogout'])->name('admin.logout');

    Route::get('auth/reset-password',[AuthController::class,'resetPassword'])->name('auth.otp.send');

    Route::post('auth/verify/email',[AuthController::class,'Forget_Password_OTP'])->name('auth.verify.email');

    Route::post('auth/otp/verify',[AuthController::class,'OTP_Verify'])->name('auth.verify.otp');

    Route::post('auth/company/register',[AuthController::class,'RegisterCompany'])->name('auth.register.company');


//--------------------Frontend Routes------------------------------------------------

    //=======Hotel Booking otp===================


    Route::post('/hotels/booking', [\App\Http\Controllers\HotelBooking::class, 'BookingRequest'])->name('front.booking.hotel');

    Route::get('/hotels/booking/otp', [\App\Http\Controllers\HotelBooking::class, 'verificationBooking'])->name('front.hotel.otp');

    Route::post('/hotels/booking/otp/verification', [\App\Http\Controllers\HotelBooking::class, 'OTP_Verify'])->name('front.hotel.otp.verify');


    //=======END Hotel Booking otp===================

    Route::get('/hotels', [CommonController::class, 'hotel'])->name('front.hotel-list');

    Route::post('/hotels/filter', [CommonController::class, 'filter'])->name('front.hotel-list.filter');

    Route::get('/hotels/about/{id}', [CommonController::class, 'showHotelDetails'])->name('front.hotel.about');

    Route::get('tour-list',[CommonController::class,'TourList'])->name('front.tour-list');

    Route::get('tour-details/{id}',[CommonController::class,'TourDetails'])->name('front.tour.detail');

    Route::get('contact',[CommonController::class,'Contact'])->name('front.contact');
    Route::get('login',[CommonController::class,'Login'])->name('front.login');

    Route::get('pricing',[CommonController::class,'Pricing'])->name('front.pricing');

    Route::get('faq',[CommonController::class,'Faq'])->name('front.faq');

    Route::get('about-us',[CommonController::class,'About'])->name('front.about');

    Route::post('about-us/store',[CommonController::class,'ContactForm'])->name('front.contact.store');

    Route::get('gallery',[CommonController::class,'gallery'])->name('front.gallery');

    Route::post('/tour-list/filter', [CommonController::class, 'filterTours'])->name('front.tour-list.filter');

    Route::get('destination',[CommonController::class,'destination'])->name('front.des');
    Route::get('destination/about/{id}',[CommonController::class,'destinationDetail'])->name('front.des.about');

//------------------- SSLCOMMERZ Start------------------------------------------

    Route::post('sslcommerz/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');

    Route::post('sslcommerz/buy/plan', [SslCommerzPaymentController::class, 'BuyPlan'])->name('buy.plan');

    Route::post('sslcommerz/success', [SslCommerzPaymentController::class, 'success']);

    Route::post('sslcommerz/fail', [SslCommerzPaymentController::class, 'fail']);

    Route::post('sslcommerz/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('sslcommerz/ipn', [SslCommerzPaymentController::class, 'ipn']);

//-------------------- SSLCOMMERZ END --------------------------------


});
