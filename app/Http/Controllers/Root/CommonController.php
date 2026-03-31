<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\CompanyPackage;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Hotel;
use App\Models\IpBlock;
use App\Models\Package;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class CommonController extends Controller
{
    public function hotel()
    {
        $hotels = Hotel::with('images')->inRandomOrder()->get();

        return view('theme.hotel',compact('hotels'));
    }

    public function filter(Request $request)
    {
        $query = Hotel::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        if ($request->filled('address')) {
            $query->where('address', $request->address);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $hotels = $query->orderBy('created_at', 'desc')->get();

        $html = view('partials.hotels-cards', ['hotels' => $hotels])->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => $hotels->count()
        ]);
    }

    public function showHotelDetails($id)
    {
        $hotel = Hotel::with('images')->find(base64_decode($id));
        return view('theme.hotel-details', compact('hotel'));
    }

    public function filterTours(Request $request)
{
    $query = Package::where('status','active')->query();

    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->location) {
        $query->where('end_location', $request->location);
    }

    if ($request->tour_type) {
        $query->where('tour_type', $request->tour_type);
    }

    if ($request->min_price) {
        $query->where('amount', '>=', $request->min_price);
    }

    if ($request->max_price) {
        $query->where('amount', '<=', $request->max_price);
    }

    if ($request->duration) {
        if ($request->duration == '15+') {
            $query->where('day', '>=', 15);
        } else {
            $range = explode('-', $request->duration);
            $query->whereBetween('day', [$range[0], $range[1]]);
        }
    }

    $tours = $query->get();
    $html = view('partials.tour-cards', compact('tours'))->render();

    return response()->json([
        'success' => true,
        'html' => $html,
        'count' => $tours->count()
    ]);
}

    public function TourList()
    {
        $tours = Package::where('status', 'active')
            ->inRandomOrder()
            ->get();

        return view('theme.tour-listing',compact('tours'));
    }

    public function TourDetails($id)
    {
        $key = $_SERVER['REMOTE_ADDR'];

        if(RateLimiter::tooManyAttempts($key,3))
        {
            $seconds = RateLimiter::availableIn($key);
            return redirect()->route('front.tour-list')->with('error',`Too many attempts . Try {$seconds} later ...`);
        }

        RateLimiter::hit($key,240);

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
        $packages = CompanyPackage::inRandomOrder()->where('p_status', 'active')->get();

        return view('theme.pricing',compact('packages'));
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
        $data = Gallery::all();
        return view('theme.gallery',compact('data'));
    }

}
