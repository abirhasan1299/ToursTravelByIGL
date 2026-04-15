<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public $table = 'buses';
    protected $guarded = [];

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function getAvailableSeatsCount($packageId = null): int
    {
        $query = Seat::where('bus_id', $this->id)
            ->where('status', '!=', 'cancelled');

        if ($packageId) {
            $query->where('package_id', $packageId);
        }

        $bookedSeatsCount = $this->getBookedSeatsList($packageId)->count();

        return $this->total_seat - $bookedSeatsCount;

    }
    public function getBookedSeatsList($packageId = null): \Illuminate\Support\Collection
    {
        $query = Seat::where('bus_id', $this->id)
            ->where('status', '!=', 'cancelled');

        if ($packageId) {
            $query->where('package_id', $packageId);
        }

        $bookings = $query->get();

        $bookedSeats = collect();
        foreach ($bookings as $booking) {
            $seats = explode(',', $booking->seat_code);
            $bookedSeats = $bookedSeats->merge($seats);
        }

        return $bookedSeats->unique()->values();
    }

}
