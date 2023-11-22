@extends('mail.master')

@section('title', 'Booking Cancelled')
@section('content')
<h1>Booking Cancelled</h1>
<p>Booking Information</p>
<table class="table table-bordered table-light">
    <tbody>
        <tr>
            <th width="30%">Appointment Booked With</th>
            <td>{{ $booking->user->name }}</td>
        </tr>
        <tr>
            <th width="30%">Appointment Booked By</th>
            <td>{{ $booking->bookedBy->name }}</td>
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
            <th>Booking Status</th>
            <td>Cancelled</td>
        </tr>
        
    </tbody>
</table>

@endsection