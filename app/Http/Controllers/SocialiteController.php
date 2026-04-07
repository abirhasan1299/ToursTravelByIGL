<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback()
    {
        $GoogleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $GoogleUser->id)->first();

        try{
            if($user){
                Auth::login($user);
            }else{
                $userData = User::create([
                    'name' => $GoogleUser->name,
                    'email' => $GoogleUser->email,
                    'password' => Hash::make('pass1234'),
                    'role' => 3,
                    'phone' => null,
                    'avatar' => $GoogleUser->avatar,
                    'google_id' => $GoogleUser->id,
                ]);

                Auth::login($userData);

            }
            return redirect('/')->with('success','Login Successfully');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect('/')->with('error','Registration or Login Failed');
        }
    }


    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $gitUser = Socialite::driver('github')->stateless()->user();

        // Try existing GitHub user
        $user = User::where('github_id', $gitUser->getId())->first();

        if (!$user) {
            // Check existing email
            $user = User::where('email', $gitUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'github_id' => $gitUser->getId(),
                    'github_avatar' => $gitUser->getAvatar(),
                ]);
            } else {
                $user = User::create([
                    'name' => $gitUser->getName() ?? $gitUser->getNickname(),
                    'email' => $gitUser->getEmail(),
                    'github_id' => $gitUser->getId(),
                    'github_avatar' => $gitUser->getAvatar(),
                    'password' => Hash::make('pass123'), // dummy password
                ]);
            }
        }

        Auth::login($user);

        return redirect('home')->with('success','Login Successfully');
    }

}
