<?php

namespace App\Http\Controllers\Bus;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Seat;
use App\Services\BkashService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function Bkashpay(Request $request, BkashService $bkashService)
    {

        try {
            // Retrieve the data we saved in the checkout method
            $bookingData = session('booking_data');

            if (!$bookingData) {
                return redirect()->route('front.tour-list')->with('error', 'Checkout session expired. Please select seats again.');
            }

            session()->put('customer', [
                'full_name'      => $request->input('customer_name'),
                'email'          => $request->input('customer_email'),
                'phone'          => $request->input('customer_phone'),
                'nid'            => $request->input('customer_nid'),
                'any_request'    => $request->input('special_requests'),
                'method' => $request->input('payment_method'),
            ]);

            //====IF COD METHOD APPLYING================

            if($request->input('payment_method')=='cod')
            {
                // Ensure it's array
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

                Seat::create([
                    'bus_id' => $bookingData['bus_id'],
                    'package_id' => $bookingData['package_id'],
                    'seat_code' => json_encode($selectedSeatCodes),
                    'status' => 'pending',
                    'user_id' => Auth::user()->id??'0',
                    'seat_no'=>json_encode($bookingData['seat_numbers'])??'null',
                    'total_amount'=>$bookingData['total_amount']??'null',
                    'full_name'      => $request->input('customer_name'),
                    'email'          => $request->input('customer_email'),
                    'phone'          => $request->input('customer_phone'),
                    'nid'            => $request->input('customer_nid'),
                    'any_request'    => $request->input('special_requests'),
                    'method' => $request->input('payment_method'),
                ]);
                DB::commit();
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
                'method' =>  $customer['method']
            ]);

            //  (Optional but recommended) update payment table
            Payment::where('payment_id', $paymentID)->update([
                'status' => $response['transactionStatus'] ?? 'Completed',
                'trx_id' => $response['trxID'] ?? null,
                'raw_response' => json_encode($response),
                'seats_id'=>$seat_created->id,
            ]);

            DB::commit();

            //  Clear session
            session()->forget(['paymentID', 'invoice', 'booking_data']);

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

}
