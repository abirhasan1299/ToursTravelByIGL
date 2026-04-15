<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class UserBooking extends Controller
{
    public function profile()
    {
        return view('users.profile');
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048'
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }

    public function userBookings()
    {
        $user = auth()->user();

        // Get paginated seat bookings
        $bookings = Seat::with('package')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Stats calculation
        $stats = [
            'total' => $bookings->total(),

            'confirmed' => Seat::where('user_id', $user->id)
                ->where('status', 'confirmed')
                ->count(),

            'pending' => Seat::where('user_id', $user->id)
                ->where('status', 'pending')
                ->count(),

            'total_amount' => Seat::where('user_id', $user->id)
                ->sum('total_amount') // FIXED column name
        ];

        return view('users.booking', compact('bookings', 'stats'));
    }
    public function cancelBooking(Request $request,$id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:4|confirmed'
        ]);

        auth()->user()->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password changed successfully!');
    }
    public function bookingForUser(Request $request)
    {
        try{

            $alreadyHas = Booking::where('user_id',Auth::id())->where('package_id',$request->package_id)->count();

            if($alreadyHas>0){
                return redirect()->route('front.tour-list')->with('error','You have already booked this package . Try another package');
            }

            $key = 'otp-book-'.Auth::user()->phone;

            if(RateLimiter::tooManyAttempts($key,1))
            {
                $seconds = RateLimiter::availableIn($key);

                return redirect()->route('front.tour-list')->with('error','Two Many OTP Request, Try again after '.$seconds.' second(s)');
            }

            RateLimiter::hit($key,240); // (4 Min ===240 seconds)

            $otp = random_int(100000,999999);
            $message="Booking Confirmation OTP: ".$otp." \n(IGL Tour)";

            sendOtp(Auth::user()->phone,$message);

            Cache::put('otp_booking'.Auth::user()->phone, $otp, now()->addMinutes(4));
            Log::info('Booking Confirmation OTP: '.$otp);

            session(['otp_phn_num_booking'=>Auth::user()->phone]);

            session([
                'user_phone'=>Auth::user()->phone,
                'user_email'=>Auth::user()->email,
                'user_address'=>$request->user_address,
                'user_name'=>Auth::user()->name,
                'package_id'=>$request->package_id,
                'date'=>$request->date,
                'quantity'=>$request->quantity,
                'total'=>0,
                'user_ip'=>$request->ip()
            ]);

            return redirect()->route('package.otp')->with('success','An OTP send to your mobile number : '.mask_phone($request->user_phone));

            }catch (\Exception $e){
                Log::error($e->getMessage());
                return redirect()->route('404')->with('error','Something went wrong');
            }
    }
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
