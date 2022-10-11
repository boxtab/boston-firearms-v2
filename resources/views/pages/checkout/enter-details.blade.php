@extends('layout.page_default')

@section('title', __('Enter Details'))

@section('page_wrapper_class', 'page-payment page-payment--checkout-make-payment')

@section('content')
@php
$sessionData = Session::get('checkout');
$client = $sessionData['client']?? [];
@endphp
@include('includes.checkout.header', ['current' => 'enter-details'])
<div class="desktop-wide-wrap">
    <div class="container">
        @include('includes.checkout.timer-block')
        <form id="quiz-contact-details-form" action="{{ route('checkout.enter-details.store', ['appointment' => $appointment->id]) }}" method="post">
            @csrf
            <input type="hidden" name="booking[appointment_id]" value="{{ $appointment->id }}">
            <input type="hidden" name="booking[booking_id]" value="{{ ( !empty( $sessionData['booking_id'] ) && $sessionData['booking_id'] > 0 ) ? $sessionData['booking_id'] : null }}">
            <input type="hidden" name="booking[client][client_id]" value="{{ ( !empty( $client['client_id'] ) && $client['client_id'] > 0 ) ? $client['client_id'] : null }}">

            <div class="input-title">
                First Name
            </div>
            <div class="input-block">
                <input type="text" name="booking[client][first_name]" maxlength="255" required placeholder="Enter Name" value="{{ old('booking.client.first_name') ?? $client['first_name'] ?? '' }}" class="@error('booking.client.first_name')is-invalid @enderror">
            </div>
            @error('booking.client.first_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="input-title">
                Last Name
            </div>
            <div class="input-block">
                <input type="text" name="booking[client][last_name]" maxlength="255" required placeholder="Enter Your Last Name" value="{{ old('booking.client.last_name') ?? $client['last_name'] ?? '' }}" class="@error('booking.client.last_name')is-invalid @enderror">
            </div>
            @error('booking.client.last_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-title">
                Date Of Birth
            </div>
            <div class="input-block">
                <input type="date" name="booking[client][date_of_birth]" required placeholder="Date Of Birth" value="{{ old('booking.client.date_of_birth') ?? $client['date_of_birth'] ?? '' }}" class="@error('booking.client.date_of_birth')is-invalid @enderror">
            </div>
            @error('booking.client.date_of_birth')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="input-title">
                Mobile Phone
            </div>
            <div class="input-block">
                <input type="text" name="booking[client][phone]" maxlength="64" required placeholder="Enter Phone Number" value="{{ old('booking.client.phone') ?? $client['phone'] ?? '' }}" class="@error('booking.client.phone')is-invalid @enderror">
            </div>
            @error('booking.client.phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="input-title">
                Email Address
            </div>
            <div class="input-block">
                <input type="email" name="booking[client][email]" maxlength="255" required placeholder="Enter Email" value="{{ old('booking.client.email') ?? $client['email'] ?? '' }}" class="@error('booking.client.email')is-invalid @enderror">
            </div>
            @error('booking.client.email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="button-row">
                <button type="submit" class="button" style="border: none">
                    Next
                </button>
            </div>
        </form>

    </div>
</div>
@stop