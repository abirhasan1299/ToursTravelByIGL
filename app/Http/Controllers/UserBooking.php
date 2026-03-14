<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class UserBooking extends Controller
{
    public function BookingRequest(Request $request)
    {
        try{

            $alreadyHaveBooking = Booking::where('package_id', $request->package_id)
                ->orWhere('user_phone', $request->user_phone)
                ->orWhere('user_email', $request->user_email)
                ->exists();

            if(!$alreadyHaveBooking)
            {
                $phoneNumber = Booking::where('user_phone',$request->user_phone)->count();
                $email = Booking::where('user_email',$request->user_email)->count();

                if($phoneNumber>=3 ||$email>=3)
                {
                    return redirect()->route('front.tour-list')->with('error','One Phone Number or Email Can Used only for different 3 packages, Use another phone number and Email');
                }
                if(!empty($request->user_phone))
                {
                    $key = 'otp-book-'.$request->user_phone;

                    if(RateLimiter::tooManyAttempts($key,1))
                    {
                        $seconds = RateLimiter::availableIn($key);

                        return redirect()->route('front.tour-list')->with('error','Two Many OTP Request, Try again after '.$seconds.' second(s)');
                    }

                    RateLimiter::hit($key,240); // (4 Min ===240 seconds)

                    $otp = random_int(100000,999999);
                    $message="Booking Confirmation OTP: ".$otp." \n(IGL Tour)";

                    sendOtp($request->user_phone,$message);

                    Cache::put('otp_booking'.$request->user_phone, $otp, now()->addMinutes(4));
                    Log::info('Booking Confirmation OTP: '.$otp);

                    session(['otp_phn_num_booking'=>$request->user_phone]);

                    session([
                        'user_phone'=>$request->user_phone,
                        'user_email'=>$request->user_email,
                        'user_address'=>$request->user_address,
                        'user_name'=>$request->user_name,
                        'package_id'=>$request->package_id,
                        'date'=>$request->date,
                        'quantity'=>$request->quantity,
                        'total'=>0,
                        'user_ip'=>$request->ip()
                    ]);

                    return redirect()->route('package.otp')->with('success','An OTP send to your mobile number : '.mask_phone($request->user_phone));

                }

            }else{
                return redirect()->route('front.tour-list')->with('error','You have already booked this package with this email or phone. Try another package');
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
            return  view('theme.otp');
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

                Booking::create([
                   'user_phone'=>session('user_phone'),
                   'user_email'=>session('user_email'),
                   'user_address'=>session('user_address'),
                   'user_name'=>session('user_name'),
                   'package_id'=>session('package_id'),
                   'date'=>session('date'),
                   'quantity'=>session('quantity'),
                   'total'=>0,
                   'user_ip'=>session('user_ip')
                ]);

                //Clear all cache and Sessions
                Cache::forget('otp_booking'.session('otp_phn_num_booking'));
                session()->flush();

                return redirect()->route('front.tour-list')->with('success','Package is Successfully Booked');

            }else{
                return redirect()->route('package.otp')->with('error','Invalid OTP');
            }
        }
        return redirect()->route('404')->with('error','Unauthorized Access');
    }

}
