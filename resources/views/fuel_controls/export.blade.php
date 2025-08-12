<table>
    <thead>
        <tr>
            <th class="p-2">Date</th>
            <th class="p-2">Ticket Number</th>
            <th class="p-2">Plate No.</th>
            <th class="p-2">Distance (km)</th>
            <th class="p-2">Gas Consumed (L)</th>
            <th class="p-2">Office</th>
            <th class="p-2">Driver</th>
            <th class="p-2">Remarks</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td class="p-2">{{ $record->date }}</td>
                <td class="p-2">{{ $record->ticket_number }}</td>
                <td class="p-2">{{ $record->plate_no }}</td>
                <td class="p-2">{{ $record->distance }}</td>
                <td class="p-2">{{ $record->gas_consumed }}</td>
                <td class="p-2">{{ $record->office }}</td>
                <td class="p-2">{{ $record->driver }}</td>
                <td class="p-2">{{ $record->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>