<table>
    <thead>
        <tr>
            <th class="p-2">Entry No.</th>
                <th class="p-2">Old Property No.</th>
                <th class="p-2">New Property No.</th>
                <th class="p-2">Description</th>
                <th class="p-2">Purchased Date</th>
                <th class="p-2">Cost</th>
                <th class="p-2">Location</th>
                <th class="p-2">Person</th>
                <th class="p-2">Quantity</th>
                <th class="p-2">Remarks</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td class="p-2 text-center">{{ $loop->iteration }}.</td>
                    <td class="p-2 text-center">{{ $item->old }}</td>
                    <td class="p-2 text-center">{{ $item->new }}</td>
                    <td class="p-2 text-center">{{ $item->description }}</td>
                    <td class="p-2 text-center">{{ $item->date }}</td>
                    <td class="p-2 text-center">{{ $item->cost }}</td>
                    <td class="p-2 text-center">{{ $item->location }}</td>
                    <td class="p-2 text-center">{{ $item->person }}</td>
                    <td class="p-2 text-center">{{ $item->stock_quantity }}</td>
                    <td class="p-2 text-center">{{ $item->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>