@extends('layout.page_default')

@section('title', __('Search'))

@section('page_wrapper_class', 'page-request')

@section('content')
<div class="desktop-wide-wrap">
    <form class="request-form" action="{{route('certificate.search.handle')}}" method="post">
        <div class="field-wrap">
            <input type="email" name="email" required maxlength="255" placeholder="Enter your Email Address here*" value="{{ old('email') ?? '' }}" class="@error('email')is-invalid @enderror">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="field-wrap calendar">
            <input type="date" name="date_of_birth" required placeholder="Enter your DOB here*" value="{{ old('date_of_birth') ?? '' }}" class="@error('date_of_birth')is-invalid @enderror">
            @error('date_of_birth')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="button-row">
            <button class="button" type="submit">Search</button>
        </div>
        @csrf
    </form>
</div>
@include('includes.footer.location-row')
@stop