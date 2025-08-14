<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacilityBooking;

class BookingController extends Controller
{
    public function index(Request $request)    // <-- Request $request is required
    {
        $facilityFilter = $request->get('facility');

        $bookings = FacilityBooking::when($facilityFilter, function ($query, $facility) {
            return $query->where('facility_name', $facility);
        })->orderBy('start_datetime')->get();

        $events = $bookings->map(function ($b) {
            $color = match ($b->status) {
                'Approved' => '#16a34a',   // green
                'Rejected' => '#dc2626',   // red
                default => '#f59e0b',   // yellow
            };

            return [
                'title' => trim($b->facility_name . ' — ' . $b->event_name),
                'start' => optional($b->start_datetime)->format('Y-m-d\TH:i:s'),
                'end' => optional($b->end_datetime)->format('Y-m-d\TH:i:s'),
                'color' => $color,
                'extendedProps' => [
                    'facility' => $b->facility_name,
                    'requestor' => $b->requestor_name,
                    'start' => ($b->start_datetime)->format('Y-m-d\TH:i:s'),
                    'end' => ($b->end_datetime)->format('Y-m-d\TH:i:s'),
                    'status' => $b->status,
                    'remarks' => $b->remarks,
                ]
            ];
        });

        $facilities = FacilityBooking::select('facility_name')
            ->distinct()
            ->pluck('facility_name');

        return view('booking.index', [
            'events' => $events,
            'facilities' => $facilities,
            'selectedFacility' => $facilityFilter
        ]);
    }

    public function create()
    {
        return view('booking.request');
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_name' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'requestor_name' => 'required|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after_or_equal:start_datetime',
        ]);

        FacilityBooking::create([
            'facility_name' => $request->facility_name,
            'event_name' => $request->event_name,
            'requestor_name' => $request->requestor_name,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'status' => 'Pending', // Default status
            'remarks' => null,      // Optional for now
        ]);

        return redirect()
            ->route('booking.index')
            ->with('success', 'Booking request submitted successfully and is pending approval.');
    }

}
