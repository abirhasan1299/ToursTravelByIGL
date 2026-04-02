<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class HotelBooking extends Controller
{

    /**
     * Hotel Booking OTP Functions
     */
    public function BookingRequest(Request $request)
    {
        try{

            $alreadyHaveBooking = \App\Models\HotelBooking::where('hotel_id', $request->hotel_id)
                ->orWhere('phone', $request->user_phone)
                ->orWhere('email', $request->user_email)
                ->exists();

            if(!$alreadyHaveBooking)
            {
                $phoneNumber = \App\Models\HotelBooking::where('phone',$request->phone)->count();
                $email = \App\Models\HotelBooking::where('email',$request->email)->count();

                if($phoneNumber>=3 ||$email>=3)
                {
                    return redirect()->route('front.hotel-list')->with('error','One Phone Number or Email Can Used only for different 3 packages, Use another phone number and Email');
                }
                if(!empty($request->phone))
                {
                    $key = 'otp-book-'.$request->phone;

                    if(RateLimiter::tooManyAttempts($key,1))
                    {
                        $seconds = RateLimiter::availableIn($key);

                        return redirect()->route('front.hotel-list')->with('error','Two Many OTP Request, Try again after '.$seconds.' second(s)');
                    }

                    RateLimiter::hit($key,240); // (4 Min ===240 seconds)

                    $otp = random_int(100000,999999);
                    $message="Hotel Booking Confirmation OTP: ".$otp." \n (IGL Tour)";

                    sendOtp($request->phone,$message);

                    Cache::put('otp_booking'.$request->phone, $otp, now()->addMinutes(4));
                    Log::info('Hotel Booking Confirmation OTP: '.$otp);

                    session(['otp_phn_num_booking'=>$request->phone]);

                    session([
                        'phone'=>$request->phone,
                        'email'=>$request->email,
                        'guest'=>$request->guest,
                        'rooms'=>$request->rooms,
                        'full_name'=>$request->full_name,
                        'hotel_id'=>$request->hotel_id,
                        'total_price'=>$request->total_price,
                        'booking_range'=>$request->booking_range,
                        'special_request'=>$request->special_request,
                    ]);

                    return redirect()->route('front.hotel.otp')->with('success','An OTP send to your mobile number : '.mask_phone($request->user_phone));

                }

            }else{
                return redirect()->route('front.hotel-list')->with('error','You have already booked this package with this email or phone. Try another package');
            }

        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('404')->with('error','Something went wrong');
        }
    }

    public function verificationBooking()
    {
        if(!empty(session('otp_phn_num_booking')))
        {
            return  view('theme.hotel_booking_otp');
        }else{
            return redirect()->route('404')->with('error','Not Permission to Access');
        }
    }

    public function OTP_Verify(Request $request)
    {

        $request->validate([
            'otp'=>'required|numeric|digits:6',
        ]);

        if(!empty(session('otp_phn_num_booking')))
        {
            if($request->otp==Cache::get('otp_booking'.session('otp_phn_num_booking')))
            {
                //Create Booking Request

                \App\Models\HotelBooking::create([
                    'phone'=>session('phone'),
                    'email'=>session('email'),
                    'rooms'=>session('rooms'),
                    'total_price'=>session('total_price'),
                    'hotel_id'=>session('hotel_id'),
                    'booking_range'=>session('booking_range'),
                   'guest'=>session('guest'),
                    'special_request'=>session('special_request'),
                    'full_name'=>session('full_name'),
                ]);

                //Clear all cache and Sessions
                Cache::forget('otp_booking'.session('otp_phn_num_booking'));
                session()->flush();

                return redirect()->route('front.hotel-list')->with('success','Hotel is Successfully Booked. We will contact you soon');

            }else{
                return redirect()->route('front.hotel.otp')->with('error','Invalid OTP');
            }
        }
        return redirect()->route('404')->with('error','Unauthorized Access');
    }
}
