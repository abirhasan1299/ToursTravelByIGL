<?php

namespace App\Http\Controllers\Bus;

use App\Http\Controllers\Controller;
use App\Mail\Bkash_Confirm_Booking;
use App\Mail\CancelRequest;
use App\Mail\Cash_On_Delivery_Confirm_Booking;
use App\Mail\otpmail;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Seat;
use App\Services\BkashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Log;

class BusController extends Controller
{

    public function index()
    {
        $data = Bus::orderBy('id', 'desc')->get();
        return view('bus.index',compact('data'));
    }

    public function create()
    {
        return view('bus.create');
    }

    public function edit($id)
    {
        $bus = Bus::findOrFail($id);
        return view('bus.edit',compact('bus'));
    }

    public function update(Request $request, $id)
    {
        $bus = Bus::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'total_seat' => 'required|integer|min:1|max:40',
            'bus_type' => 'required',
            'status' => 'required',
            'driver_name' => 'required|string|max:255',
            'driver_exp' => 'required|integer|min:0|max:40',
            'model' => 'nullable|string|max:255',
            'reg_number' => 'nullable|string|max:100|unique:buses,reg_number,' . $id,
            'contact_number' => 'nullable|string|max:20',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update bus
        $bus->update([
            'name' => $request->name,
            'total_seat' => $request->total_seat,
            'bus_type' => $request->bus_type,
            'status' => $request->status,
            'driver_name' => $request->driver_name,
            'driver_exp' => $request->driver_exp,
            'model' => $request->model,
            'reg_number' => $request->reg_number,
            'contact_number' => $request->contact_number,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('admin.bus.index')
            ->with('success', 'Bus updated successfully!');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'total_seat'      => 'required|integer|min:1|max:100',
            'bus_type'        => 'required',
            'status'          => 'required|in:active,inactive,maintenance',
            'driver_name'     => 'required|string|max:255',
            'driver_exp'      => 'nullable|integer|min:0|max:40',
            'model'           => 'nullable|string|max:255',
            'reg_number'      => 'nullable|string|max:100|unique:buses,reg_number',
            'contact_number'  => 'nullable|string|max:20',
            'notes'           => 'nullable|string',
        ]);

        $bus = Bus::create($validated);

        return redirect()
            ->route('admin.bus.index')
            ->with('success', 'Bus created successfully!');
    }

    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();
        return redirect()->route('admin.bus.index')->with('success', 'Bus deleted successfully!');
    }

    /*
     * ====================================
     * Bus Booking Seat Layout Function
     * ====================================
     */
    public function layout(Request $request)
    {
        $bus_id = base64_decode($request->bus_id);
        $package_id = base64_decode($request->package_id);

        $bus_info = Bus::find($bus_id);
        $package_info = Package::find($package_id);

        $AlreadyBookings = Seat::where('bus_id', $bus_id)
            ->where('package_id', $package_id)
            ->get();

        $bookedSeats = $AlreadyBookings
            ->pluck('seat_code')
            ->map(fn($item) => json_decode($item, true)) // decode JSON
            ->flatten() // merge all arrays
            ->toArray();
        return view('bus.layout', compact('bus_info', 'bookedSeats','package_info'));
    }

    /*
     * ====================================
     * Bkash Checkout Function
     * ====================================
     */
    public function Bkashpay()
    {

        try {
            $bkashService =  new BkashService();
            // Retrieve the data we saved in the checkout method
            $bookingData = session('booking_data');

            if (!$bookingData) {
                return redirect()->route('front.tour-list')->with('error', 'Checkout session expired. Please select seats again.');
            }

            //====IF COD METHOD APPLYING================

            if(session('customer.method')=='cod')
            {
                // Ensure it is array
                if (is_object($bookingData)) {
                    $bookingData = (array) $bookingData;
                }
                DB::beginTransaction();
                //Lock existing bookings
                $existingBookings = Seat::where('bus_id', $bookingData['bus_id'])
                    ->where('package_id', $bookingData['package_id'])
                    ->where('status', '!=', 'cancelled')
                    ->lockForUpdate()
                    ->get();

                // Collect booked seats
                $bookedSeatCodes = [];

                foreach ($existingBookings as $booking) {
                    // Support both JSON and comma-separated
                    $seats = is_string($booking->seat_codes)
                        ? (json_decode($booking->seat_codes, true) ?: explode(',', $booking->seat_codes))
                        : $booking->seat_codes;

                    if (is_array($seats)) {
                        $bookedSeatCodes = array_merge($bookedSeatCodes, $seats);
                    }
                }

                $bookedSeatCodes = array_unique($bookedSeatCodes);

                $selectedSeatCodes = is_array($bookingData['seat_codes'])
                    ? $bookingData['seat_codes']
                    : json_decode($bookingData['seat_codes'], true);

                $conflictingSeats = array_intersect($selectedSeatCodes, $bookedSeatCodes);

                if (!empty($conflictingSeats)) {
                    DB::rollBack();

                    return redirect()->back()->with(
                        'error',
                        'Sorry, seats ' . implode(', ', $conflictingSeats) . ' were just booked. Please select different seats.'
                    );
                }

                $booking = Seat::create([
                    'bus_id' => $bookingData['bus_id'],
                    'package_id' => $bookingData['package_id'],
                    'seat_code' => json_encode($selectedSeatCodes),
                    'status' => 'pending',
                    'user_id' => Auth::user()->id??'0',
                    'seat_no'=>json_encode($bookingData['seat_numbers'])??'null',
                    'total_amount'=>$bookingData['total_amount']??'null',
                    'full_name'      => session('customer.full_name'),
                    'email'          => session('customer.email'),
                    'phone'          => session('customer.phone'),
                    'nid'            => session('customer.nid'),
                    'any_request'    => session('customer.any_request'),
                    'method' => 'COD',
                ]);

                Mail::to($booking->email)->send(new Cash_On_Delivery_Confirm_Booking($booking));

                DB::commit();
                session()->flush();
                return redirect()->route('front.tour-list')->with('success', 'Package  booked successfully ! ');
            }

            $amount =session('booking_data.total_amount');
            $invoice = 'INV_' . time() . '_' . uniqid();
            $callbackUrl = route('bkash.callback');

            $response = $bkashService->createPayment($amount, $invoice, $callbackUrl);

            if ($response['success']) {
                session([
                    'paymentID' => $response['paymentID'],
                    'invoice' => $invoice
                ]);

                return redirect($response['bkashURL']);
            }

            return back()->with('error', $response['error'] ?? 'Payment initialization failed');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bkashpay exception: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function callback(Request $request, BkashService $bkashService)
    {

        try {
            //  Validate callback
            if ($request->status !== 'success' || !$request->paymentID) {
                return redirect()->route('front.tour-list')
                    ->with('error', 'Payment was cancelled or failed.');
            }

            $paymentID = $request->paymentID;

            // Execute payment
            $response = $bkashService->executePayment($paymentID);

            if (!$bkashService->isPaymentSuccessful($response)) {
                return redirect()->route('front.tour-list')
                    ->with('error', 'Payment execution failed. Please contact support.');
            }

            //  Get session data
            $bookingData = session('booking_data');

            if (!$bookingData) {
                return redirect()->route('front.tour-list')
                    ->with('error', 'Session expired. Please try booking again.');
            }

            // Ensure it's array
            if (is_object($bookingData)) {
                $bookingData = (array) $bookingData;
            }

            DB::beginTransaction();

            // Lock existing bookings
            $existingBookings = Seat::where('bus_id', $bookingData['bus_id'])
                ->where('package_id', $bookingData['package_id'])
                ->where('status', '!=', 'cancelled')
                ->lockForUpdate()
                ->get();

            //  Collect booked seats
            $bookedSeatCodes = [];

            foreach ($existingBookings as $booking) {
                // Support both JSON and comma-separated
                $seats = is_string($booking->seat_codes)
                    ? (json_decode($booking->seat_codes, true) ?: explode(',', $booking->seat_codes))
                    : $booking->seat_codes;

                if (is_array($seats)) {
                    $bookedSeatCodes = array_merge($bookedSeatCodes, $seats);
                }
            }

            $bookedSeatCodes = array_unique($bookedSeatCodes);

            // Selected seats
            $selectedSeatCodes = is_array($bookingData['seat_codes'])
                ? $bookingData['seat_codes']
                : json_decode($bookingData['seat_codes'], true);

            //  Conflict check (FIXED)
            $conflictingSeats = array_intersect($selectedSeatCodes, $bookedSeatCodes);

            if (!empty($conflictingSeats)) {
                DB::rollBack();

                return redirect()->back()->with(
                    'error',
                    'Sorry, seats ' . implode(', ', $conflictingSeats) . ' were just booked. Please select different seats.'
                );
            }

            //  Insert booking (example)
            $customer = session('customer');

            $seat_created = Seat::create([
                'bus_id' => $bookingData['bus_id'],
                'package_id' => $bookingData['package_id'],
                'seat_code' => json_encode($selectedSeatCodes),
                'status' => 'booked',
                'user_id' => Auth::user()->id??'0',
                'seat_no'=>json_encode($bookingData['seat_numbers'])??'null',
                'total_amount'=>$bookingData['total_amount']??'null',
                'full_name'      => $customer['full_name'],
                'email'          =>  $customer['email'],
                'phone'          =>  $customer['phone'],
                'nid'            =>  $customer['nid'],
                'any_request'    =>  $customer['any_request'],
                'method' => "Bkash"
            ]);

            //  (Optional but recommended) update payment table
           $transaction =  Payment::where('payment_id', $paymentID)->update([
                'status' => $response['transactionStatus'] ?? 'Completed',
                'trx_id' => $response['trxID'] ?? null,
                'raw_response' => json_encode($response),
                'seats_id'=>$seat_created->id,
            ]);

            DB::commit();

            Mail::to($customer['email'])->send(new Bkash_Confirm_Booking($seat_created, $transaction));

            //  Clear session
            session()->flush();

            return redirect()->route('front.tour-list')
                ->with('success', 'Payment successful! Your booking is confirmed.');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Bkash callback exception', [
                'error' => $e->getMessage(),
                'paymentID' => $request->paymentID ?? null
            ]);

            return redirect()->route('front.tour-list')
                ->with('error', 'Something went wrong with payment verification.');
        }
    }

    /*
     * ====================================
     * Bus Checkout Function
     * ====================================
     */
    public function checkout(Request $request)
    {

        // Get parameters from the URL
        $bus_id = $request->query('bus_id');
        $package_id = $request->query('package_id');
        $seats_json = $request->query('seats');
        $total_seats = $request->query('total_seats');
        $total_amount = $request->query('total_amount');
        $seat_codes_json = $request->query('seat_codes');
        $seat_numbers_json = $request->query('seat_numbers');

        // Parse JSON data
        $selectedSeats = json_decode($seats_json, true);
        $seatCodes = json_decode($seat_codes_json, true);
        $seatNumbers = json_decode($seat_numbers_json, true);

        // Get bus information
        $busInfo = Bus::findOrFail($bus_id);

        // Get package information if needed
        $package = Package::find($package_id);

        // Calculate pricing
        $seatPrice = $package->price; // From your URL, each seat is 43
        $subtotal = $total_amount;
        $vat = $subtotal * 0; // 0% VAT
        $totalAmount = $subtotal + $vat;

        session()->put('booking_data', [
            'bus_id' => $bus_id,
            'package_id' => $package_id,
            'package_name' => $package->name,
            'package_price' => $package->price,
            'seats' => $seatNumbers,
            'seat_codes' => $seatCodes,
            'seat_numbers' => $seatNumbers,
            'total_amount' => $totalAmount,
            'vat' => $vat,
            'subtotal'       => $subtotal
        ]);

        // You might want to get these from your database
        $startLocation = $package->start_location ?? 'Dhaka';
        $endLocation = $package->end_location ?? "Cox's Bazar";


        return view('bus.checkout', compact(
            'busInfo',
            'package_id',
            'selectedSeats',
            'seatCodes',
            'seatNumbers',
            'total_seats',
            'totalAmount',
            'subtotal',
            'vat',
            'seatPrice',
            'startLocation',
            'endLocation'
        ));
    }

    /**
     * Show OTP page and send initial OTP.
     * Accessible via:  POST /bus/booking/otp  (route: bus.otp.cod)
     */
    public function OtpForCod(Request $request)
    {
        // Prefer request values, fall back to session
        $email     = $request->input('customer_email', Session::get('customer.email', ''));
        $phone     = $request->input('customer_phone', Session::get('customer.phone', ''));
        $otpMethod = $request->input('otp_method',     Session::get('customer.otp_method', 'email'));

        // FIX: normalise method to only accepted values
        $otpMethod = in_array($otpMethod, ['email', 'phone']) ? $otpMethod : 'email';

        // Persist in session for the rest of the flow
        Session::put('customer.email',      $email);
        Session::put('customer.phone',      $phone);
        Session::put('customer.otp_method', $otpMethod);

        // Generate a unique token that ties this OTP to the page load
        $otpToken = uniqid('otp_', true);

        // Generate 6-digit OTP
        $otp = random_int(100000, 999999);   // FIX: use random_int (cryptographically secure)

        // FIX: expiry is now 300 seconds (5 minutes)
        Session::put('otp.' . $otpToken, [
            'code'       => (string) $otp,
            'method'     => $otpMethod,
            'contact'    => $otpMethod === 'email' ? $email : $phone,
            'expires_at' => time() + 300,
        ]);

        // Send OTP
        if ($otpMethod === 'email') {
            $this->sendOtpByEmail($email, $otp);
        } else {
            $this->sendOtpBySms($phone, $otp);
        }

        return view('bus.cod-otp', [
            'otpToken'     => $otpToken,
            'contactEmail' => $email,      // FIX: use contactEmail to match blade $contactEmail
            'contactPhone' => $phone,      // FIX: use contactPhone to match blade $contactPhone
        ]);
    }

    /**
     * Resend OTP to the same (or updated) contact.
     * Accessible via:  POST /bus/booking/otp/resend  (route: bus.otp.resend)
     */
    public function OtpResend(Request $request)
    {
        try {
            $request->validate([
                'contact_value' => 'required|string|max:255',
                'otp_method'    => 'required|in:email,phone',
                'otp_token'     => 'required|string',
            ]);

            $otpToken = $request->input('otp_token');

            // FIX: if the session key no longer exists (e.g. expired session),
            //      create a new entry instead of hard-failing
            if (!Session::has('otp.' . $otpToken)) {
                // Attempt to re-use a token from any surviving sibling key,
                // or just create a fresh slot under the same token.
                Log::warning('OTP Resend: token not in session, creating fresh entry.', [
                    'token' => $otpToken,
                ]);
            }

            $otp = random_int(100000, 999999);

            // FIX: expiry 300 seconds (5 minutes)
            Session::put('otp.' . $otpToken, [
                'code'       => (string) $otp,
                'method'     => $request->input('otp_method'),
                'contact'    => $request->input('contact_value'),
                'expires_at' => time() + 300,
            ]);

            // Also update session customer fields so they stay in sync
            if ($request->input('otp_method') === 'email') {
                Session::put('customer.email',      $request->input('contact_value'));
                Session::put('customer.phone',      $request->input('phone', Session::get('customer.phone', '')));
            } else {
                Session::put('customer.phone',      $request->input('contact_value'));
                Session::put('customer.email',      $request->input('email', Session::get('customer.email', '')));
            }
            Session::put('customer.otp_method', $request->input('otp_method'));

            // Send
            if ($request->input('otp_method') === 'email') {
                $this->sendOtpByEmail($request->input('contact_value'), $otp);
            } else {
                $this->sendOtpBySms($request->input('contact_value'), $otp);
            }

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully.',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => collect($e->errors())->flatten()->first(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Resend OTP Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP. Please try again.',
            ], 500);
        }
    }

    /**
     * Update contact info and send fresh OTP.
     * Accessible via:  POST /bus/contact/update  (route: bus.contact.update)
     */
    public function updateContact(Request $request)
    {
        try {
            $request->validate([
                'contact_value' => 'required|string|max:255',
                'otp_method'    => 'required|in:email,phone',
                'otp_token'     => 'required|string',
            ]);

            $otpToken = $request->input('otp_token');
            $method   = $request->input('otp_method');
            $contact  = $request->input('contact_value');

            // Update session customer fields
            if ($method === 'email') {
                Session::put('customer.email', $contact);
                // preserve phone if it was already stored
                if (!Session::has('customer.phone')) {
                    Session::put('customer.phone', '');
                }
            } else {
                Session::put('customer.phone', $contact);
                if (!Session::has('customer.email')) {
                    Session::put('customer.email', '');
                }
            }
            Session::put('customer.otp_method', $method);

            // Generate new OTP — expiry 300 s (5 minutes)
            $otp = random_int(100000, 999999);

            Session::put('otp.' . $otpToken, [
                'code'       => (string) $otp,
                'method'     => $method,
                'contact'    => $contact,
                'expires_at' => time() + 300,
            ]);

            // Send
            if ($method === 'email') {
                $this->sendOtpByEmail($contact, $otp);
            } else {
                $this->sendOtpBySms($contact, $otp);
            }

            return response()->json([
                'success' => true,
                'message' => 'Contact updated and OTP sent successfully.',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => collect($e->errors())->flatten()->first(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update Contact Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update contact information.',
            ], 500);
        }
    }

    /**
     * Verify OTP and proceed.
     * Accessible via:  POST /bus/booking/otp/verification  (route: bus.otp.cod.verify)
     */
    public function OtpVerify(Request $request)
    {
        try {
            $request->validate([
                'otp'       => 'required|string|size:6',
                'otp_token' => 'required|string',
            ]);

            $otpToken = $request->input('otp_token');

            if (!Session::has('otp.' . $otpToken)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Session expired. Please request a new OTP.');
            }

            $otpData = Session::get('otp.' . $otpToken);

            // Check expiry
            if (time() > $otpData['expires_at']) {
                Session::forget('otp.' . $otpToken);
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'OTP has expired. Please request a new one.');
            }

            // FIX: use hash_equals for timing-safe comparison (prevents timing attacks)
            if (!hash_equals((string) $otpData['code'], (string) $request->input('otp'))) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['otp' => 'Invalid OTP. Please try again.']);
            }

            // Verified — clean up OTP from session
            Session::forget('otp.' . $otpToken);

            // Redirect to payment / success
            return redirect()->route('bkash.pay');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('OTP Verification Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Verification failed. Please try again.');
        }
    }

    /**
     * Send OTP via Email.
     */
    private function sendOtpByEmail(string $email, int $otp): void
    {
        if (empty(trim($email))) {
            Log::warning('sendOtpByEmail called with empty email.');
            return;
        }
        try {
            Mail::to($email)->send(new otpmail($otp));
            Log::info('OTP email sent.', ['email' => $email]);
        } catch (\Exception $e) {
            Log::error('Email Sending Error: ' . $e->getMessage(), ['email' => $email]);
        }
    }

    /**
     * Send OTP via SMS.
     */
    private function sendOtpBySms(string $phone, int $otp): void
    {
        if (empty(trim($phone))) {
            Log::warning('sendOtpBySms called with empty phone.');
            return;
        }
        try {
            sendOtp($phone, $otp);   // your existing global helper
            Log::info('OTP SMS sent.', ['phone' => $phone]);
        } catch (\Exception $e) {
            Log::error('SMS Sending Error: ' . $e->getMessage(), ['phone' => $phone]);
        }
    }

    public function BookingCancel($id)
    {
        try{
            DB::beginTransaction();
            $data = Seat::findOrFail($id);
            Mail::to($data->email)->send(new CancelRequest($data));
            $data->delete();
            DB::commit();

            return back()->with('success', 'Booking cancelled successfully.');

        }catch (\Exception $e){
            DB::rollBack();
            Log::error("Bus Seat Cancel Exception: ". $e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function paymentInfo($id)
    {
        try{
            $decode_id =Crypt::decryptString($id);
            $booking = Seat::findOrFail($decode_id);
            $transaction = Payment::where('seats_id', $decode_id)->first();

            return view('admin.post.information', compact('booking', 'transaction'));

        }catch (\Exception $e){
            Log::error("Bus Payment Info Exception: ". $e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }

}
