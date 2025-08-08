<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacilityBooking;

class BookingController extends Controller
{   
    public function index()
         {
        // load bookings (you can add filters here later)
        $bookings = FacilityBooking::orderBy('start_datetime')->get();

        // convert to FullCalendar-friendly event array
        $events = $bookings->map(function ($b) {
            return [
                'id'    => $b->id,
                'title' => trim($b->facility_name . ' — ' . $b->event_name),
                // ensure ISO format; casting gives Carbon
                'start' => $b->start_datetime ? $b->start_datetime->format('Y-m-d\TH:i:s') : null,
                'end'   => $b->end_datetime ? $b->end_datetime->format('Y-m-d\TH:i:s') : null,
                'color' => $b->status === 'Approved'
                            ? '#16a34a'     // green
                            : ($b->status === 'Rejected' ? '#dc2626' : '#f59e0b'), // red or amber
                // extra data for modal
                'extendedProps' => [
                    'requestor' => $b->requestor_name,
                    'status'    => $b->status,
                    'remarks'   => $b->remarks,
                    'facility'  => $b->facility_name,
                ],
            ];
        });

        // pass events as JSON-aware collection
        return view('booking.index', [
            'events' => $events,
        ]);
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
