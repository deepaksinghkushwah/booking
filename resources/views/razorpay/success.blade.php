@extends('app')

@section('title', 'Book an appointment')
@section('content')
<h1>Booking Confirmed</h1>
<p>Booking Information</p>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>Appointment Booked With</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Booking ID</th>
            <td>{{ $booking->id }}</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>{{ $booking->booking_date }}</td>
        </tr>
        <tr>
            <th>Time Slot</th>
            <td>{{ $booking->booking_slot }}</td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>Confirmed</td>
        </tr>
        
    </tbody>
</table>

@endsection