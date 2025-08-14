@extends('website.layoutPublic')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Facility Booking Calendar</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('booking.index') }}" class="mb-4 flex items-center space-x-2">
            <select name="facility" onchange="this.form.submit()" class="border border-gray-300 rounded px-3 py-1 text-sm">
                <option value="">All Facilities</option>
                @foreach ($facilities as $facility)
                    <option value="{{ $facility }}" {{ $selectedFacility == $facility ? 'selected' : 'CSO' }}>
                        {{ $facility }}
                    </option>
                @endforeach
            </select>
            <a href="{{ route('booking.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800">
                Submit Booking Request
            </a>
        </form>

        <!-- Calendar -->
        <div class="fc fc-media-screen">
            <div id="calendar" class="bg-white p-4 rounded shadow min-h-[600px]"></div><br>
        </div>
    </div>

    <!-- Modal -->
    <div id="eventModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg max-w-lg w-full p-6">
            <div class="flex justify-between items-start">
                <h3 id="modalTitle" class="text-xl font-bold"></h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-900">&times;</button>
            </div>
            <div class="mt-4 text-sm text-gray-700">
                <p><strong>Facility:</strong> <span id="modalFacility"></span></p>
                <p><strong>Requestor:</strong> <span id="modalRequestor"></span></p>
                <p><strong>Start Time:</strong> <span id="modalStart"></span></p>
                <p><strong>End Time:</strong> <span id="modalEnd"></span></p>
                <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                <p class="mt-2"><strong>Remarks:</strong></p>
                <p id="modalRemarks" class="whitespace-pre-wrap"></p>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
                    eventTimeFormat: {
                        hour: 'numeric',
                        minute: '2-digit',
                        meridiem: 'short'
                    },

                    eventClick: function(info) {
                        const props = info.event.extendedProps;

                        // Format the start and end time
                        const startTime = info.event.start ?
                            new Intl.DateTimeFormat('en-US', {
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: true
                            })
                            .format(info.event.start) :
                            '';

                        const endTime = info.event.end ?
                            new Intl.DateTimeFormat('en-US', {
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: true
                            })
                            .format(info.event.end) :
                            '';

                        document.getElementById('modalTitle').innerText = info.event.title || 'Booking';
                        document.getElementById('modalFacility').innerText = props.facility || '';
                        document.getElementById('modalRequestor').innerText = props.requestor || '';
                        document.getElementById('modalStatus').innerText = props.status || '';
                        document.getElementById('modalStart').textContent = startTime;
                        document.getElementById('modalEnd').textContent = endTime;
                        document.getElementById('modalRemarks').innerText = props.remarks || '';

                        var modal = document.getElementById('eventModal');
                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    }
                });

                calendar.render();

                document.getElementById('closeModal').addEventListener('click', function() {
                    var modal = document.getElementById('eventModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });

                document.getElementById('eventModal').addEventListener('click', function(e) {
                    if (e.target.id === 'eventModal') {
                        this.classList.add('hidden');
                        this.classList.remove('flex');
                    }
                });
            });
        </script>
    @endpush
@endsection
