<?php

namespace App\Http\Controllers\Bus;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Package;
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
     * Bus Booking Confirmation Function
     * ====================================
     */

    public function booking(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('front.login')->with('error','Please Login First');
        }

        // Start timing for lock timeout handling
        $startTime = microtime(true);
        $maxWaitTime = 10; // Maximum wait time in seconds

        try {
            DB::beginTransaction();

            // Parse the seats data
            $seats = json_decode($request->seats, true);

            if (empty($seats)) {
                return redirect()->back()->with('error', 'No seats selected!');
            }

            // Extract seat codes and numbers
            $seatCodes = is_array($request->seat_codes) ? $request->seat_codes : explode(',', $request->seat_codes);
            $seatNumbers = is_array($request->seat_numbers) ? $request->seat_numbers : explode(',', $request->seat_numbers);

            $busId = $request->bus_id;
            $packageId = $request->package_id;
            $userId = auth()->id() ?? 20;

            // ================================================
            // PESSIMISTIC LOCKING - Check if seats are available
            // ================================================

            // Get all existing bookings for this bus and package
            // Using lockForUpdate() to prevent concurrent modifications
            $existingBookings = Seat::where('bus_id', $busId)
                ->where('package_id', $packageId)
                ->where('status', '!=', 'cancelled')
                ->lockForUpdate()
                ->get();

            // Collect all already booked seat codes
            $bookedSeatCodes = [];
            foreach ($existingBookings as $booking) {
                $bookingSeats = explode(',', $booking->seat_code);
                $bookedSeatCodes = array_merge($bookedSeatCodes, $bookingSeats);
            }
            $bookedSeatCodes = array_unique($bookedSeatCodes);

            // Check if any selected seat is already booked
            $conflictingSeats = array_intersect($seatCodes, $bookedSeatCodes);

            if (!empty($conflictingSeats)) {
                DB::rollBack();
                $conflictList = implode(', ', $conflictingSeats);
                return redirect()->back()->with('error', "Sorry, seats {$conflictList} were just booked by someone else. Please select different seats.");
            }

            // ================================================
            // DOUBLE-CHECK WITH DATABASE QUERY (Atomic Check)
            // ================================================

            // Build a query to check each seat individually
            $seatCheckQuery = Seat::where('bus_id', $busId)
                ->where('package_id', $packageId)
                ->where('status', '!=', 'cancelled')
                ->where(function($query) use ($seatCodes) {
                    foreach ($seatCodes as $code) {
                        $query->orWhereRaw("FIND_IN_SET(?, seat_code)", [$code]);
                    }
                });

            $conflictingBookings = $seatCheckQuery->lockForUpdate()->get();

            if ($conflictingBookings->count() > 0) {
                DB::rollBack();

                // Get the conflicting seat codes
                $conflictCodes = [];
                foreach ($conflictingBookings as $booking) {
                    $bookingSeats = explode(',', $booking->seat_code);
                    $conflictCodes = array_merge($conflictCodes, array_intersect($seatCodes, $bookingSeats));
                }
                $conflictList = implode(', ', array_unique($conflictCodes));

                return redirect()->back()->with('error', "Sorry, seats {$conflictList} were just booked. Please try again.");
            }

            // ================================================
            // CALCULATE TOTAL AMOUNT
            // ================================================
            $busInfo = Bus::find($busId);
            $pricePerSeat = $busInfo->price_per_seat ?? 0;
            $totalAmount = count($seatCodes) * $pricePerSeat;

            // ================================================
            // CREATE BOOKING WITH UNIQUE CONSTRAINT CHECK
            // ================================================

            $seatCodesString = implode(',', $seatCodes);
            $seatNumbersString = implode(',', $seatNumbers);


            // Create the booking record
            $booking = Seat::create([
                'bus_id' => $busId,
                'package_id' => $packageId,
                'user_id' => $userId,
                'seat_code' => $seatCodesString,
                'seat_no' => $seatNumbersString,
                'total_amount' => $totalAmount,
                'status' => 'confirmed',
            ]);

            // ================================================
            // VERIFY BOOKING WAS CREATED SUCCESSFULLY
            // ================================================

            if (!$booking) {
                throw new \Exception('Failed to create booking record');
            }

            DB::commit();

            // Log successful booking
            Log::info('Seat booking successful', [
                'booking_id' => $booking->id,
                'user_id' => $userId,
                'bus_id' => $busId,
                'seats' => $seatCodesString,
                'amount' => $totalAmount
            ]);

            return redirect()->route('front.tour-list')
                ->with('success', 'Seats booked successfully!');

        } catch (\Exception $exception) {

            DB::rollBack();

            Log::error('Seat booking failed', [
                'error' => $exception->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'bus_id' => $request->bus_id ?? null,
                'seats' => $request->seat_codes ?? null,
                'trace' => $exception->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Booking failed. Please try again or contact support.');
        }
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
            if ($request->status == 'success' && $request->paymentID) {

                $paymentID = $request->paymentID;
                $response = $bkashService->executePayment($paymentID);

                if ($bkashService->isPaymentSuccessful($response)) {

                    // 1. Get the booking data from session
                    $bookingData = session('booking_data');

                    if($bookingData) {
                        // 2. THIS is where you put your DB::beginTransaction()
                        // and lockForUpdate() logic from your old booking() method.
                        // You parse the seat codes, check if they are still free,
                        // and insert them into the `Seat` table.

                        /* Insert Booking code here */
                    }

                    // 3. Clear session
                    session()->forget(['paymentID', 'invoice', 'booking_data']);

                    return redirect()->route('front.tour-list')
                        ->with('success', 'Payment successful! Your booking is confirmed.');
                }

                return redirect()->route('front.tour-list')
                    ->with('error', 'Payment execution failed. Please contact support.');
            }

            return redirect()->route('front.tour-list')
                ->with('error', 'Payment was cancelled or failed.');

        } catch (\Exception $e) {
            Log::error('Bkash callback exception: ' . $e->getMessage());
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
        $vat = $subtotal * 0.05; // 5% VAT
        $totalAmount = $subtotal + $vat;

        session('booking_data', [
            'bus_id' => $bus_id,
            'package_id' => $package_id,
            'package_name' => $package->name,
            'package_price' => $package->price,
            'seats' => $seatNumbers,
            'seat_codes' => $seatCodes,
            'seat_numbers' => $seatNumbers,
            'total_amount' => $totalAmount,
            'vat' => $vat,
            'subtotal' => $subtotal
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
