@extends('layout.page_default')

@section('title', __('About Us'))

@section('page_wrapper_class', 'page-about-us')

@section('content')

@include('includes.about-us.about-section')

@include('includes.footer.location-row')

@stop
