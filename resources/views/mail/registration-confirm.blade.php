@extends('mail.master')

@section('title', 'User Registered')
@section('content')
<h1>Hello {{ $user->name }}</h1>
<p>Welcome to {{ config("app.name") }}. You are registered as {{ $user->email }} and your account is activated. You can now login to book your appointments.</p>
@endsection