<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Ticket No</th>
            <th>Plate No</th>
            <th>Distance</th>
            <th>Gas Consumed</th>
            <th>Gas Type</th>
            <th>Office</th>
            <th>Driver</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        @foreach($fuel_records as $record)
            <tr>
                <td>{{ $record->date }}</td>
                <td>{{ $record->ticket_number }}</td>
                <td>{{ $record->plate_no }}</td>
                <td>{{ $record->distance }}</td>
                <td>{{ $record->gas_consumed }}</td>
                <td>{{ $record->gas_type }}</td>
                <td>{{ $record->office }}</td>
                <td>{{ $record->driver }}</td>
                <td>{{ $record->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
