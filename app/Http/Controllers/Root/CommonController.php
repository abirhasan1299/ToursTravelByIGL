<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\CompanyPackage;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Hotel;
use App\Models\HotelBooking;
use App\Models\IpBlock;
use App\Models\Package;
use App\Models\Contact;
use App\Models\Seo;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class CommonController extends Controller
{
    public function hotel()
    {
        $hotels = Hotel::with('images')->inRandomOrder()->get();
        $seo = Seo::where('page_name','hotels')->first();

        return view('theme.hotel',compact('hotels','seo'));
    }

    public function destination()
    {
        $data = Destination::with('images')->inRandomOrder()->get();
        $seo = Seo::where('page_name','destination')->first();

        return view('theme.destination',compact('data','seo'));
    }
    public function destinationDetail($id)
    {
        $data = Destination::with('images')->findOrFail(base64_decode($id));
        return view('theme.destination-detail',compact('data'));
    }

    public function BookingHotel(Request $request)
    {
        $data = $request->validate([
           'hotel_id' => 'required|exists:hotels,id',
           'booking_range' => 'required',
           'guest' => 'nullable',
           'rooms' => 'required|numeric|min:1',
           'total_price' => 'required',
           'full_name' => 'nullable',
           'email' => 'nullable|email|exists:users,email',
           'phone' => 'nullable|phone|exists:users,phone',
           'special_request' => 'nullable',
        ]);

        if(auth()->check())
        {
            HotelBooking::create([
                'hotel_id' => $data['hotel_id'],
                'booking_range' => $data['booking_range'],
                'guest' => $data['guest'],
                'rooms' => $data['rooms'],
                'total_price' => $data['total_price'],
                'special_request' => $data['special_request'],
                'user_id' => auth()->user()->id,
            ]);

        }else{
            HotelBooking::create($data);
        }
        return redirect()->route('front.hotel-list')->with('success','Hotel Booking Successfully');
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
        $query = Package::where('status', 'active');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('location')) {
            $query->where('end_location', $request->location);
        }

        if ($request->filled('tour_type')) {
            $query->where('tour_type', $request->tour_type);
        }

        if ($request->filled('min_price')) {
            $query->where('amount', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('amount', '<=', $request->max_price);
        }

        if ($request->filled('duration')) {
            if ($request->duration == '15+') {
                $query->where('day', '>=', 15);
            } else {
                $range = explode('-', $request->duration);
                if (count($range) == 2) {
                    $query->whereBetween('day', [(int)$range[0], (int)$range[1]]);
                }
            }
        }

        $tours = $query->latest()->get();

        $html = view('partials.tour-cards', compact('tours'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => $tours->count()
        ]);
    }

    public function TourList(Request $request)
    {
        $query = Package::where('status', 'active');
        $seo = Seo::where('page_name','tour-list')->first();
        // Apply filters from URL parameters

        if ($request->filled('location')) {

            $location = strtolower(trim($request->input('location')));

            $parts = preg_split('/\s+to\s+/', $location);

            if (count($parts) === 2) {
                [$start_loc, $end] = $parts;

                $query->where('start_location', $start_loc);
                $query->where('end_location', $end);
            }
        }

        if ($request->filled('tour_type')) {
            $query->where('tour_type', $request->tour_type);
        }


        if ($request->filled('duration')) {
            $duration = $request->duration;
            if ($duration == '1-3') {
                $query->whereBetween('day', [1, 3]);
            } elseif ($duration == '4-7') {
                $query->whereBetween('day', [4, 7]);
            } elseif ($duration == '8-14') {
                $query->whereBetween('day', [8, 14]);
            } elseif ($duration == '15+') {
                $query->where('day', '>=', 15);
            }
        }

        if ($request->filled('guests')) {
            $query->where('max_people', '>=', $request->guests);
        }

        // Get filtered tours (IMPORTANT: Use the query, not a new query)
        $tours = $query->inRandomOrder()->get();

        // Get max price for the slider
        $maxPrice = Package::max('amount') ?? 50000;

        return view('theme.tour-listing', compact('tours', 'maxPrice','seo'));
    }

    public function TourDetails($id)
    {
     //   $key = $_SERVER['REMOTE_ADDR'];
//
//        if(RateLimiter::tooManyAttempts($key,3))
//        {
//            $seconds = RateLimiter::availableIn($key);
//            return redirect()->route('front.tour-list')->with('error',`Too many attempts . Try {$seconds} later ...`);
//        }
//
//        RateLimiter::hit($key,240);

        $tour = Package::findOrFail(base64_decode($id));
        $activities = Activity::where('package_id', $tour->id)->get();

        return view('theme.tour-listing-details',compact('tour','activities'));

    }

    public function Contact()
    {
        $seo = Seo::where('page_name','contact')->first();
        return view('theme.contact',compact('seo'));
    }

    public function Login()
    {
        $seo = Seo::where('page_name','login')->first();
        return view('theme.login',compact('seo'));
    }

    public function Pricing()
    {
        $packages = CompanyPackage::inRandomOrder()->where('p_status', 'active')->get();

        return view('theme.pricing',compact('packages'));
    }

    public function About()
    {
        $seo = Seo::where('page_name','about-us')->first();
        return view('theme.about',compact('seo'));
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
        $seo = Seo::where('page_name','faq')->first();
        return view('theme.faq',compact('data','seo'));
    }

    public function gallery()
    {
        $data = Gallery::all();
        $seo = Seo::where('page_name','gallery')->first();
        return view('theme.gallery',compact('data','seo'));
    }



}
