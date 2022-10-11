@extends('layout.page_default')

@section('title', __('Event Details'))

@section('page_wrapper_class', 'page-class')

@section('content')
@yield('class-top-section')

@yield('class-central-section')

@yield('class-faq')

@yield('class-other-classes')

@include('includes.footer.location-row')
@stop