<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function createCompany()
    {
        return view('admin.company.create');
    }

    public function listCompany()
    {
        $data  = User::where('role',2)->get();
        return view('admin.company.list',compact('data'));
    }

    public function store(Request $request)
    {
       $request->validate([
          'firstname' => 'required',
          'lastname' => 'required',
          'useremail' => 'required|unique:users,email',
          'phone' => 'required|unique:users,phone',
          'userpassword' => 'required',
          'profilephoto' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
       ]);

       $user = new User();
       $user->name = $request->firstname." ".$request->lastname;
       $user->email = $request->useremail;
       $user->password = Hash::make($request->userpassword);
       $user->phone = $request->phone;
       $user->role = 2;
       $user->status = 'pending';
       $user->company_id = random_int(100000, 999999);
       $user->save();

       $profile = new Profile();
       $profile->user_id = $user->id;
       $profile->bio = $request->userbio;
       $profile->address_1 = $request->address_line_1;
       $profile->address_2 = $request->address_line_2;
       $profile->city = $request->city;
       $profile->state = $request->state;
       $profile->zipcode = $request->zipcode;
       $profile->country = $request->country;
       $profile->company_name = $request->companyname;
       $profile->website = $request->cwebsite;
       if ($request->hasFile('profilephoto')) {

            $file = $request->file('profilephoto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profilePhoto', $filename, 'public');
            $profile->profile_photo = $path;
        }
       $profile->save();


       $social = new Social();
       $social->user_id = $user->id;
       $social->fb = $request->fb;
       $social->tw =$request->tw;
       $social->in = $request->insta;
       $social->ln = $request->lin;
       $social->git = $request->git;
       $social->drb = $request->drb;
       $social->save();

       return redirect()->route('admin.list-company')->with('success', 'Company has been added successfully');

    }
}
