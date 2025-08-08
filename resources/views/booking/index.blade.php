@extends('website.layout')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Facility Booking Calendar</h1>

    <a href="{{ route('booking.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 mb-4 inline-block">
        Submit Booking Request
    </a>

    <div id="calendar" class="bg-white p-4 rounded shadow"></div>
</div>

<!-- Modal (hidden by default) -->
<div id="eventModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white rounded-lg max-w-lg w-full p-6">
    <div class="flex justify-between items-start">
      <h3 id="modalTitle" class="text-xl font-bold"></h3>
      <button id="closeModal" class="text-gray-500 hover:text-gray-900">&times;</button>
    </div>
    <div class="mt-4 text-sm text-gray-700">
      <p><strong>Facility:</strong> <span id="modalFacility"></span></p>
      <p><strong>Requestor:</strong> <span id="modalRequestor"></span></p>
      <p><strong>Status:</strong> <span id="modalStatus"></span></p>
      <p class="mt-2"><strong>Remarks:</strong></p>
      <p id="modalRemarks" class="whitespace-pre-wrap"></p>
      <p class="mt-3 text-xs text-gray-500">Click outside or the × to close.</p>
    </div>
  </div>
</div>

<!-- FullCalendar CDN (head could include CSS too) -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // events from controller; ensure default to empty array if missing
    var calendarEvents = {!! isset($events) ? $events->toJson() : '[]' !!};

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: calendarEvents,
        eventTimeFormat: { hour: 'numeric', minute: '2-digit', meridiem: 'short' },

        // show details modal on click
        eventClick: function(info) {
            var evt = info.event;
            var props = evt.extendedProps || {};

            document.getElementById('modalTitle').innerText = evt.title || 'Booking';
            document.getElementById('modalFacility').innerText = props.facility || '';
            document.getElementById('modalRequestor').innerText = props.requestor || '';
            document.getElementById('modalStatus').innerText = props.status || '';
            document.getElementById('modalRemarks').innerText = props.remarks || '';

            // show modal
            var modal = document.getElementById('eventModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    });

    calendar.render();

    // modal close handlers
    document.getElementById('closeModal').addEventListener('click', function() {
        var modal = document.getElementById('eventModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    // click outside to close
    document.getElementById('eventModal').addEventListener('click', function(e) {
        if (e.target.id === 'eventModal') {
            this.classList.add('hidden');
            this.classList.remove('flex');
        }
    });
});
</script>
@endsection
