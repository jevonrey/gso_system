<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FacilityBooking;

class BookingAdminController extends Controller
{
    public function index()
    {
        $bookings = FacilityBooking::orderBy('start_datetime')->get();
        return view('admin.booking.index', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = FacilityBooking::findOrFail($id);
        return view('admin.booking.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = FacilityBooking::findOrFail($id);

        $booking->update($request->validate([
            'facility_name' => 'required',
            'event_name' => 'required',
            'requestor_name' => 'required',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after_or_equal:start_datetime',
            'status' => 'required|in:Pending,Approved,Rejected',
            'remarks' => 'nullable',
        ]));

        return redirect()->route('admin.booking.index')->with('success', 'Booking updated.');
    }

    public function destroy($id)
    {
        FacilityBooking::destroy($id);
        return back()->with('success', 'Booking deleted.');
    }
}
