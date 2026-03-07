<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect()->route('admin.login');
    }
}
