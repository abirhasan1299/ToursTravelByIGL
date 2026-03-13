<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Faq;
use App\Models\Package;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommonController extends Controller
{
    public function TourList()
    {
        $tours = Package::where('status', 'active')
            ->inRandomOrder()
            ->get();

        return view('theme.tour-listing',compact('tours'));
    }

    public function TourDetails($id)
    {
        $tour = Package::findOrFail(base64_decode($id));
        $activities = Activity::where('package_id', $tour->id)->get();

        return view('theme.tour-listing-details',compact('tour','activities'));

    }

    public function Contact()
    {
        return view('theme.contact');
    }

    public function Login()
    {
        return view('theme.login');
    }

    public function Pricing()
    {
        return view('theme.pricing');
    }

    public function About()
    {
        return view('theme.about');
    }

    public function ContactForm(Request $request)
    {
       try{
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'detail' => $request->message,
                'location' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('home')->with('success','Contact Form Submitted Successfully. We will contact you soon.');

       }catch (\Exception $e){
           Log::error($e->getMessage());
           return redirect()->route("home")->with('error','Something went wrong');
       }
    }

    public function Faq()
    {
        $data = Faq::where('status','active')->orderBy('id','desc')->get();
        return view('theme.faq',compact('data'));
    }

    public function gallery()
    {
        return view('theme.gallery');
    }

}
