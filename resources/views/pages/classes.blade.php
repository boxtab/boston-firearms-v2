@extends('layout.page_default')

@section('title', __('Classes'))

@section('page_wrapper_class', 'page-classes')

@section('content')

    @include('includes.classes.partials.featured-classes')

    @include('includes.classes.partials.central-class')

    @include('includes.classes.partials.other-classes')

    @include('includes.home.philosophy')

    @include('includes.footer.location-row')

@stop

@push('styles')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" type="text/css">
@endpush

@push('footer-scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="/js/common.js" type="text/javascript"> </script>
@endpush
