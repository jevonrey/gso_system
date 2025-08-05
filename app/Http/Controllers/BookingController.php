<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacilityBooking;

class BookingController extends Controller
{   
    public function index()
        {
            $bookings = FacilityBooking::orderBy('start_datetime')->get();
            return view('booking.index', compact('bookings'));
        }

    public function create()
        {
            return view('booking.request');
        }

    public function store(Request $request)
        {
            $request->validate([
                'facility_name' => 'required',
                'event_name' => 'required',
                'requestor_name' => 'required',
                'start_datetime' => 'required|date',
                'end_datetime' => 'required|date|after_or_equal:start_datetime',
            ]);

            FacilityBooking::create($request->all());

            return redirect()->route('booking.index')->with('success', 'Booking request submitted!');
        }
}
