<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function AdminLogin()
    {
        return view('auth.admin-login');
    }
    public function AdminLoginPost(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            $request->session()->regenerate();

            if(Auth::user()->role==1)
            {
                return redirect()->route('admin.dashboard');
            }
            elseif (Auth::user()->role==2)
            {
                return redirect()->route('company.dashboard');
            }

        }
        return back()->with('error','Invalid Credentials');
    }

    public function AdminLogout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }

    public function Forget_Password_OTP(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
        ]);

        $user = User::where('email',$request->email)->first();

        if(!empty($user))
        {
            $key = 'otp-'.$user->phone;

            if(RateLimiter::tooManyAttempts($key,3))
            {
                $seconds = RateLimiter::availableIn($key);

                return redirect()->route('login')->with('error','Two Many OTP Request, Try again after '.$seconds.' second(s)');
            }

            RateLimiter::hit($key,240); // (4 Min ===240 seconds)

            $otp = random_int(100000,999999);
            $message="Password Reset  OTP: ".$otp." \n(IGL Tour)";

            sendOtp($user->phone,$message);

            Cache::put('otp_'.$user->phone, $otp, now()->addMinutes(4));
            Log::error($otp);

            session(['otp_phn_num'=>$user->phone]);

            return redirect()->route('auth.otp.send')->with('success','An OTP send to your mobile number : '.mask_phone($user->phone));

        }else{
            return redirect()->route('login')->with('error','No Account Found');
        }
    }

    public function resetPassword()
    {
        if(empty(session('otp_phn_num')))
        {
            return redirect()->route('login')->with('error','Unauthorized Access');
        }

        return view('auth.forget');
    }

    public function OTP_Verify(Request $request)
    {
        $request->validate([
           'otp'=>'required|numeric|digits:6',
           'new_password'=>'required|min:4',
           'confirm_password'=>'required|same:new_password'
        ]);

        if(!empty(session('otp_phn_num')))
        {
            if($request->otp==Cache::get('otp_'.session('otp_phn_num')))
            {
                //Update the password
                $user = User::where('phone',session('otp_phn_num'))->first();
                $user->password = Hash::make($request->new_password);
                $user->save();

                //Clear all cache and Sessions
                Cache::forget('otp_'.session('otp_phn_num'));
                session()->flush();

                return redirect()->route('login')->with('success','Password Changed Successfully');
            }else{
                return redirect()->route('auth.otp.send')->with('error','Invalid OTP');
            }
        }
        return redirect()->route('login')->with('error','Unauthorized Access');
    }

    public function RegisterCompany(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'useremail' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'profilephoto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->useremail;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->role = 2;
        $user->status = 'pending';
        $user->company_id = random_int(100000, 999999);
        $user->save();


        return redirect()->route('front.login')->with('success', 'Registration successfully done');

    }

}
