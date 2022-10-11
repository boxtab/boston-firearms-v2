@extends('layout.page_default')

@section('title', __('Lane Reservation'))

@section('page_wrapper_class', 'page-lane-reservation')

@section('content')

@include('includes.lane-reservation.lane-reservation-section')

@stop
