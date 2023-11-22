@extends('app')
@section('title','Member Dashboard')
@section('content')
<h1>Booking History</h1>
@if(count($bookings)>0)
<table class="table table-striped">
    <thead>
        <tr class="bg-dark text-white">
            <th>Booking ID#</th>
            <th>Booked With</th>
            <th>Date</th>
            <th>Time</th>            
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->booking_date }}</td>
            <td>{{ $item->booking_slot }}</td>
            <td>
            @if($item->status == 0)
                   Unpaid
                @elseif($item->status ==1)
                    Confirmed
                @else
                    Cancelled
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
No booking history found
@endif
@endsection