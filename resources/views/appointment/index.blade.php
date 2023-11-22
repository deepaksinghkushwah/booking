@extends('app')

@section('title', 'Book an appointment')
@section('content')
<h1>Book an Appointment</h1>
<p>Select one for booking</p>
<div class="appointment-users-grid">
    @foreach($users as $user)
    <div class="card">
        
        <div class="card-body">
            <div class="card-text">
                {{ $user->name }}
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route("appointment.show-slots",["id" => $user->id]) }}" class="btn btn-primary float-right">Book</a>
        </div>
    </div>        
    @endforeach
</div>

@endsection